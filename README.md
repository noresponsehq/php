# NoResponse for PHP

The NoResponse client for PHP 8.2 and later. It assesses a signup or gateway event, polls a pending assessment, pages through an account's history, records what you later learned, rotates your API key and verifies webhooks. The client is generated from the NoResponse OpenAPI document; webhook verification and the wait helper are hand-written.

Keep the API key on your server.

## Install

There is no Packagist package yet. Add the GitHub repository to your `composer.json` and require the package:

```json
{
    "repositories": [
        { "type": "vcs", "url": "https://github.com/noresponsehq/php" }
    ],
    "require": {
        "noresponse/noresponse-php": "^2.0"
    }
}
```

```bash
composer update noresponse/noresponse-php
```

Composer reads the version tags from https://github.com/noresponsehq/php/tags.

## Quick start

```php
<?php

require 'vendor/autoload.php';

use NoResponse\Models\Shared\AssessmentRequest;
use NoResponse\Models\Shared\AssessmentRequestIdentifiers;
use NoResponse\Models\Shared\ResponseMode;
use NoResponse\Models\Shared\Status;
use NoResponse\NoResponseClient;
use NoResponse\Wait;

$client = NoResponseClient::create(getenv('NORESPONSE_API_KEY'));

$response = $client->assessments->create(new AssessmentRequest(
    accountId: 'usr_8f2k1',
    identifiers: new AssessmentRequestIdentifiers(email: 'jordan.lee@example.com'),
));

$assessment = $response->result;
if ($assessment->status === Status::Pending) {
    // No recommendation yet. Apply your fallback now, then wait or take the webhook.
    $assessment = Wait::wait($client, $assessment->assessmentId);
}

echo $assessment->recommendation?->value; // allow, step_up or review
```

Every method returns an envelope: `result` holds the object and `headers` the response headers (`X-Request-ID`, `Retry-After`, `Idempotent-Replayed`).

## Configure the client

```php
$client = NoResponseClient::builder()
    ->setSecurity(getenv('NORESPONSE_API_KEY'))   // or ->setSecuritySource(fn () => $key)
    ->setServerUrl('https://api.noresponse.org')  // the default
    ->setClient(new \GuzzleHttp\Client(['timeout' => 10, 'proxy' => 'http://proxy:8080']))
    ->setRetryConfig(new \NoResponse\Utils\Retry\RetryConfigNone())
    ->build();
```

`NoResponseClient::create($apiKey)` is the same as the builder with only the key. A builder given no key reads it from the `NORESPONSE_API_KEY` environment variable when `build()` runs, so `NoResponseClient::builder()->build()` works too; a key you set wins over the environment. Timeouts, proxies and TLS settings belong to the Guzzle client you pass to `setClient`.

## Assessments

```php
$created = $client->assessments->create(
    new AssessmentRequest(
        accountId: 'usr_8f2k1',
        identifiers: new AssessmentRequestIdentifiers(email: 'jordan.lee@example.com'),
        responseMode: ResponseMode::Detailed, // detailed needs the detailed scope
    ),
    idempotencyKey: 'signup-usr_8f2k1-0001',
);

$latest = $client->assessments->get($created->result->assessmentId);
$settled = Wait::wait($client, $created->result->assessmentId, timeoutSeconds: 30);
```

`Wait::wait` polls `assessments->get` until the status is no longer pending, sleeping the server's `Retry-After` (at least one second) between polls. It throws `WaitTimeoutException`, which carries the last pending assessment, when the timeout (default 30 s) passes.

### Query an account's history

`query` returns a generator of pages, newest first:

```php
use NoResponse\Models\Shared\AssessmentQuery;

foreach ($client->assessments->query(new AssessmentQuery(accountId: 'usr_8f2k1', limit: 20)) as $page) {
    foreach ($page->result->items as $item) {
        // each assessment at its latest version
    }
}
```

### Record an outcome

```php
use NoResponse\Models\Shared\AssessmentOutcomeRequest;
use NoResponse\Models\Shared\Outcome;

$client->assessments->recordOutcome(
    new AssessmentOutcomeRequest(outcome: Outcome::Chargeback, externalRef: 'case-42'),
    $created->result->assessmentId,
);
```

### Idempotency

`create` and `recordOutcome` send a fresh UUID as the `Idempotency-Key` when you pass none, and the same key on every retry of that call, so a retried request is recorded once. Pass your own key to make a retry from your side replay the same assessment: the API answers the latest version with `Idempotent-Replayed: true`. The same key with a different body answers 409 (`ConflictException`).

## Keys

```php
use NoResponse\Models\Shared\KeyRotationRequest;

$rotation = $client->keys->rotate(new KeyRotationRequest(overlapSeconds: 3600));
// $rotation->result->key is the new key, shown once. Rotate with the new key next time.
```

## Errors

Every API error extends `NoResponse\Models\Errors\NoResponseException`. The problem-document exceptions expose `getStatusCode()`, `getRequestId()` and the typed problem document as `$e->container` (`type`, `title`, `detail`, `code`, `invalidParams`).

| Exception | When |
|---|---|
| `BadRequestException` | 400: the body or a header is malformed; see `container->invalidParams` |
| `AuthenticationException` | 401: missing, malformed, revoked or expired key |
| `PermissionDeniedException` | 403: the key lacks the operation's scope |
| `NotFoundException` | 404: unknown, expired or foreign assessment |
| `ConflictException` | 409: idempotency key reused with a different body, or a key already rotating |
| `RateLimitException` | 429, after the retries (which honour `Retry-After`) ran out |
| `APIStatusException` | any other 4xx or 5xx, including 503; has `statusCode`, `body` and `rawResponse` |

```php
use NoResponse\Models\Errors\APIStatusException;
use NoResponse\Models\Errors\NoResponseException;
use NoResponse\Models\Errors\RateLimitException;

try {
    $client->assessments->create($request);
} catch (RateLimitException $e) {
    // Retries already honoured Retry-After and ran out: apply your fallback.
    applyFallback($e->getRequestId());
} catch (APIStatusException $e) {
    logError($e->statusCode, $e->body);
} catch (NoResponseException $e) {
    logError($e->getMessage()); // a problem-document exception: see getStatusCode() and getRequestId()
} catch (\GuzzleHttp\Exception\GuzzleException $e) {
    // DNS, TLS or connection failure: apply your fallback.
}
```

## Retries

Connection errors, 408, 429 and every 5xx are retried with exponential backoff (500 ms to 8 s, 30 s in all). 409 and other 4xx are not retried. A connection failure throws a `GuzzleException` whether retries are on or off. Override for the client with `setRetryConfig`, or for one call with `Options`:

```php
use NoResponse\Utils\Options;
use NoResponse\Utils\Retry\RetryConfigNone;

$client->assessments->create($request, options: Options::builder()->setRetryConfig(new RetryConfigNone())->build());
```

## Issued keys

When your signup gate issues an API key to the new account, send only its hash, as `issued_credential.sha256`; the key itself never leaves your backend.

```php
$sha256 = \NoResponse\IssuedCredential::sha256($issuedKey);
```

## Webhooks

Register an endpoint, store its signing secret, then send it test events:

```php
use NoResponse\Models\Shared\WebhookEndpointRequest;
use NoResponse\Models\Shared\WebhookTestRequest;
use NoResponse\Models\Shared\WebhookTestRequestEvent;

$created = $client->webhookEndpoints->create(new WebhookEndpointRequest(url: 'https://app.example.com/webhooks/noresponse'))->result;
// store $created->signingSecret->keyId and ->secret where your receiver reads them
$endpointId = $created->endpoint->endpointId;
$check = $client->webhookEndpoints->sendTestEvent(new WebhookTestRequest(WebhookTestRequestEvent::EndpointVerification), $endpointId); // $check->result->verified
$client->webhookEndpoints->sendTestEvent(new WebhookTestRequest(WebhookTestRequestEvent::AssessmentUpdated), $endpointId); // $event->test is true
```

`list`, `rotateSigningKey` (the old key verifies for 7 more days) and `delete` manage it afterwards.

Verify the exact bytes you received, then act on the typed event. `$secrets` maps each `whk_` key id we give you to its secret; hold both during a rotation.

```php
use NoResponse\Models\Shared\Assessment;
use NoResponse\Webhooks\VerificationException;
use NoResponse\Webhooks\Webhook;

$payload = file_get_contents('php://input');
try {
    $event = Webhook::constructEvent($payload, getallheaders(), [$keyId => $secret]);
} catch (VerificationException $e) {
    http_response_code(400); // $e->code says which check failed
    exit;
}

if ($event->type === 'endpoint.verification') {
    header('Content-Type: application/json');
    echo json_encode(Webhook::verificationResponse($event));
    exit;
}
if ($event->test) {
    // sendTestEvent's fixed example assessment: apply nothing
} elseif ($event->isExpired()) {
    // forget the assessment: GET now answers 404
} elseif ($event->data instanceof Assessment) {
    // keep the highest assessmentVersion per assessment
}
http_response_code(204);
```

`constructEvent` refuses a missing or repeated header, a delivery older than 300 seconds (`toleranceSeconds:` changes it), an unknown key id or a bad signature. Deliveries are at least once: deduplicate on `$event->id`. `$event->test` is true only on an `assessment.updated` event sent by `sendTestEvent`, whose data is a fixed example assessment.

### Late results

When a slow source settles and the recommendation rises after you allowed the signup, `LateResults::handleLateResult` verifies the delivery, applies your policy and acts through your auth provider. The default policy revokes sessions on `review`; pass `policy: ['step_up' => 'ban']` to change it. `ClerkProvider`, `WorkosProvider` and `Auth0Provider` take your credentials, an optional base URL and an optional PSR-18 client. A provider refusal throws `ProviderActionException`: answer 5xx so we retry. WorkOS has no block, so its ban deletes the user permanently.

```php
$result = LateResults::handleLateResult($payload, getallheaders(), [$keyId => $secret], new ClerkProvider($clerkSecretKey));
```

If your app has its own login, `new LogOnlyProvider()` logs what it would revoke or ban (through `error_log()`, or pass a callable) and calls nothing. Use it to try the handler, then implement `LateResultProvider` yourself: `name()`, `revokeSessions($userId)` and `ban($userId)`.

## Changes since 2.0.0

Names that changed:

| 2.0.0 | Now |
|---|---|
| `NoResponse\NoResponse` | `NoResponse\NoResponseClient` |
| `NoResponse\NoResponseBuilder` | `NoResponse\NoResponseClientBuilder` |
| `BadRequestErrorThrowable`, `AuthenticationErrorThrowable`, `PermissionDeniedErrorThrowable`, `NotFoundErrorThrowable`, `ConflictErrorThrowable`, `RateLimitErrorThrowable` | `BadRequestException`, `AuthenticationException`, `PermissionDeniedException`, `NotFoundException`, `ConflictException`, `RateLimitException` |
| `BadRequestError` and the other `...Error` classes | unchanged; they are the problem document held in `$e->container` |
| no shared parent | `NoResponseException`, the parent of every exception above and of `APIStatusException` |
| `create($body, string $idempotencyKey)` | `create($body, ?string $idempotencyKey = null)` |
| `recordOutcome($body, $assessmentId, string $idempotencyKey)` | `recordOutcome($body, $assessmentId, ?string $idempotencyKey = null)` |
| `Wait::wait(NoResponse $client, ...)` | `Wait::wait(NoResponseClient $client, ...)` |

`NoResponseClient::create($apiKey)` is new, a builder without a key reads `NORESPONSE_API_KEY`, `Event` has `test`, and each method's `@throws` lists every exception it throws. Three fixes ride along: with `RetryConfigNone` a connection failure throws a `GuzzleException` (it was a PHP `Error`), a retry config passed in `Options` now applies (it was replaced by the default), and 5xx responses are now retried (the status code pattern never matched).

Issues: https://github.com/noresponsehq/php/issues. Quote `getRequestId()` when you write to us.
