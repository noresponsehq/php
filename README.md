<img src="https://raw.githubusercontent.com/noresponsehq/.github/main/profile/sdk-header.png" alt="NoResponse" width="100%">

# NoResponse for PHP

The NoResponse client for PHP 8.2 and later. It assesses an account creation, login or purchase, polls a pending assessment, pages through an account's history, records what you later learned, rotates your API key and verifies webhooks. The client, webhook verification and the typed webhook events are generated from the NoResponse OpenAPI document; the wait helper is hand-written, and the auth adapters and late enforcement are rendered from shared tables.

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

use NoResponse\Models\Shared\AccountDecision;
use NoResponse\Models\Shared\AssessmentRequest;
use NoResponse\Models\Shared\AssessmentRequestIdentifiers;
use NoResponse\Models\Shared\Flow;
use NoResponse\Models\Shared\ResponseMode;
use NoResponse\NoResponseClient;
use NoResponse\Wait;

$client = NoResponseClient::create(getenv('NORESPONSE_API_KEY'));

$response = $client->assessments->create(new AssessmentRequest(
    accountId: 'usr_8f2k1',
    flow: Flow::AccountCreation,
    identifiers: new AssessmentRequestIdentifiers(email: 'jordan.lee@example.com'),
));

$assessment = $response->result;
if ($assessment->account === null) {
    // The account's first assessment is pending. Apply your fallback now, then wait or take the webhook.
    $assessment = Wait::wait($client, $assessment->id);
}

$decision = $assessment->account?->risk->decision;
echo $decision instanceof AccountDecision ? $decision->value : $decision; // allow, step_up, review or block
```

A response enum such as `AccountDecision` or `ReasonCode` is typed `AccountDecision|string`: a known value is its enum case, and a value added after this release is the raw string, so an older SDK still reads the response.

`account->risk->decision` is the decision for the request's `flow` and the value to act on. The assessment's own facts (`recommendation`, `risk`, `signals`, `assessmentVersion`) are under `detail`.

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
        flow: Flow::AccountCreation,
        identifiers: new AssessmentRequestIdentifiers(email: 'jordan.lee@example.com'),
        responseMode: ResponseMode::Detailed, // detailed needs the detailed scope
    ),
    idempotencyKey: 'account-usr_8f2k1-0001',
);

$latest = $client->assessments->get($created->result->id);
$settled = Wait::wait($client, $created->result->id, timeoutSeconds: 30);
```

`Wait::wait` polls `assessments->get` until the status is `Complete`, sleeping the server's `Retry-After` (at least one second) between polls. When the timeout (default 30 s) passes it returns the latest answer if that is `Partial`, with its status still `Partial`, and throws `WaitTimeoutException`, which carries the last pending assessment, if the assessment is still `Pending`.

### Query an account's history

`query` returns a generator of pages, newest first:

```php
use NoResponse\Models\Shared\AssessmentQuery;

foreach ($client->assessments->query(new AssessmentQuery(accountId: 'usr_8f2k1', limit: 20)) as $page) {
    foreach ($page->result->items as $item) {
        // each AssessmentDetail at its latest version
    }
}
```

### Record an outcome

```php
use NoResponse\Models\Shared\AssessmentOutcomeRequest;
use NoResponse\Models\Shared\Outcome;

$client->assessments->recordOutcome(
    new AssessmentOutcomeRequest(outcome: Outcome::Chargeback, externalRef: 'case-42'),
    $created->result->id,
);
```

### Idempotency

`create` and `recordOutcome` send a fresh UUID as the `Idempotency-Key` when you pass none, and the same key on every retry of that call, so a retried request is recorded once. Pass your own key to make a retry from your side replay the same assessment: the API answers the latest version with `Idempotent-Replayed: true`. The same key with a different body answers 409 (`ConflictException`).

`$client->assessments->delete($assessmentId)` deletes one assessment (`history` scope); the answer's `account->currentAssessmentId` names the assessment the account's risk now comes from, null when none is left, and a repeat answers 404.

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

When your platform issues an API key to the new account, send only its hash, as `issued_credential.sha256`; the key itself never leaves your backend.

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
use NoResponse\Models\Shared\AccountDeletedEvent;
use NoResponse\Models\Shared\AccountRiskChangedEvent;
use NoResponse\Models\Shared\AssessmentExpired;
use NoResponse\Models\Shared\AssessmentUpdatedEvent;
use NoResponse\Models\Shared\EndpointVerificationEvent;
use NoResponse\Models\Shared\WebhookEndpointDisabledEvent;
use NoResponse\Models\Shared\WorkspaceDeletedEvent;
use NoResponse\WebhookVerification\Webhook;
use NoResponse\WebhookVerification\WebhookVerificationException;

$payload = file_get_contents('php://input');
try {
    $event = Webhook::constructEvent($payload, getallheaders(), [$keyId => $secret]);
} catch (WebhookVerificationException $e) {
    http_response_code(400); // $e->errorCode says which check failed
    exit;
}

if ($event instanceof EndpointVerificationEvent) {
    header('Content-Type: application/json');
    echo json_encode(['challenge' => $event->data->challenge]);
    exit;
}
if ($event instanceof AssessmentUpdatedEvent && $event->test === true) {
    // sendTestEvent's fixed example assessment: apply nothing
} elseif ($event instanceof AccountDeletedEvent) {
    // account.deleted: you erased $event->data->accountId with $client->accounts->delete
} elseif ($event instanceof WorkspaceDeletedEvent) {
    // workspace.deleted: the workspace is deleted, the last event this endpoint receives
} elseif ($event instanceof WebhookEndpointDisabledEvent) {
    // webhook_endpoint.disabled: $event->data->endpointId failed for 72 hours; fix it and verify it again
} elseif ($event instanceof AccountRiskChangedEvent) {
    // account.risk_changed, the one event to act on: a flow's decision changed, at
    // $event->data->account->riskVersion. This verifier alone does not enforce it: use LateResults::handleRiskChange (below) as this endpoint's receiver.
} elseif ($event->data instanceof AssessmentExpired) {
    // forget the assessment: GET now answers 404
}
// any other assessment.updated reports progress only: apply nothing
http_response_code(204);
```

`constructEvent` returns one of six typed events from `NoResponse\Models\Shared`: `AssessmentUpdatedEvent` (data `Assessment` or `AssessmentExpired`), `EndpointVerificationEvent`, `AccountDeletedEvent`, `WorkspaceDeletedEvent`, `WebhookEndpointDisabledEvent` and `AccountRiskChangedEvent`. It throws `WebhookVerificationException` for a missing or repeated header, a delivery older than 300 seconds (`toleranceSeconds:` changes it), an unknown key id, a bad signature or a body that is not a known event; `$e->errorCode` is one of its constants (`MISSING_HEADER`, `DUPLICATE_HEADER`, `INVALID_TIMESTAMP`, `UNKNOWN_KEY`, `INVALID_SIGNATURE`, `INVALID_PAYLOAD`). Deliveries are at least once: deduplicate on `$event->id`. `$event->test` is true only on an `assessment.updated` event sent by `sendTestEvent`, whose data is a fixed example assessment.

### Late results

`account.risk_changed` only wakes your handler. `LateResults::handleRiskChange` verifies the delivery, reads the account's current risk with `accounts->get` (the event's own decision, and an event older than what you already enforced, change nothing), asks your `getAccountState` callable where the account is in your flow, and acts on the decision of that state's flow:

| State | Flow | Decision | Actions |
|---|---|---|---|
| `onboarding` | `account_creation` | `review`, `block` | `fail_onboarding`, `revoke_sessions` |
| `provisional` | `account_creation` | `review`, `block` | `reject_activation`, `revoke_sessions` |
| `active` | `login` | `review` | `revoke_sessions` |
| `active` | `login` | `block` | `restrict`, `revoke_sessions` |
| `restricted` | `login` | `allow` | `unrestrict`, only with `flows: ['login' => ['reinstate' => true]]` |

Each action, or `none` when the decision needs nothing, is recorded with `accounts->recordEnforcement` at the `riskVersion` read; store `$result->riskVersion` and return it as `enforcedRiskVersion` so a replay is skipped. Nothing ever deletes a user: Clerk bans (unban reverses it), Auth0 sets `blocked`, and WorkOS, which has no block, sets the user's metadata `noresponse_state` (gate sign-in on it) and revokes every session. A refused action is recorded as failed and throws `ProviderActionException` (`provider`, `status`, `errorCode`): answer 5xx so the delivery is retried.

```php
use NoResponse\LateResults\AccountStateAnswer;
use NoResponse\LateResults\LateResults;

$provider = LateResults::identityProvider('clerk', $clerkSecretKey); // or 'workos', or 'auth0' with domain:
$result = LateResults::handleRiskChange($client, $payload, getallheaders(), [$keyId => $secret], $provider,
    fn ($account) => new AccountStateAnswer($users->stateOf($account->id), enforcedRiskVersion: $users->enforcedVersion($account->id)));
```

`LateResults::enforceAccount` takes an account from `accounts->listChanged(unenforced: true)` to catch up on missed deliveries. For your own user store, `LateResults::customProvider(['restrict' => fn ($userId) => ..., 'revoke_sessions' => ...])` runs your callables.

A held flow (workspace settings `admission: held`) answers `held` until its investigation completes or `hold_seconds` pass, and the handler records `none` for it. When the final decision arrives as `account.risk_changed`, an `onboarding` or `provisional` account fails onboarding or is refused activation on `review` or `block`. On `allow` the handler does nothing, so admit the account yourself from the result's account. See https://docs.noresponse.org/guides/late-results.

## Changes in 6.0.0

- `AssessmentRequest` takes a required `flow` (`Flow::AccountCreation`, `Flow::Login` or `Flow::Purchase`) and an optional `depth`. `AssessmentRequestPolicyContext` no longer has `flow`.
- `create`, `get` and the `assessment.updated` webhook return the `Assessment` resource: `id`, `status`, `flow`, `depth`, `account` (the account's current risk, decided for this flow; null while the account's first assessment is pending) and `detail` (`AssessmentDetail`, the previous assessment body).
- Act on `account->risk->decision` (`allow`, `step_up`, `review`, `block`). `block` replaces `detail->risk->block`. Keep the highest `detail->assessmentVersion`.
- History pages hold `AssessmentDetail` items.

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
