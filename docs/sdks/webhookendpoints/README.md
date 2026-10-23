# WebhookEndpoints

## Overview

Your webhook endpoints: register, list, rotate signing keys, send test events and delete.

### Available Operations

* [list](#list) - List the workspace's webhook endpoints.
* [create](#create) - Register a webhook endpoint.
* [delete](#delete) - Delete a webhook endpoint.
* [rotateSigningKey](#rotatesigningkey) - Rotate an endpoint's signing key.
* [sendTestEvent](#sendtestevent) - Send a test event to an endpoint.
* [listDeliveries](#listdeliveries) - List an endpoint's delivery attempts.
* [replayDelivery](#replaydelivery) - Send one delivery again.

## list

Lists your webhook endpoints in every state, ordered by endpoint_id, with the ids of their signing keys and without secrets. Requires the webhooks scope.

### Example Usage

<!-- UsageSnippet language="php" operationID="listWebhookEndpoints" method="get" path="/v1/webhooks" example="endpoints" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->webhookEndpoints->list(

);

if ($response->webhookEndpointList !== null) {
    // handle response
}
```

### Response

**[?Operations\ListWebhookEndpointsResponse](../../Models/Operations/ListWebhookEndpointsResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## create

Registers a webhook endpoint and returns it with its first signing secret, shown only in this answer: store it where your receiver reads it. The URL is https on port 443 or 8443 with a DNS host whose every address is public; it is checked now and on every delivery. The endpoint starts unverified and receives assessment events once it echoes an endpoint.verification challenge, which sendTestEvent sends. You can hold 5 endpoints. Requires the webhooks scope, and response_mode detailed also the detailed scope. Registration is not idempotent: a retry after a lost answer registers a second endpoint, which you can list and delete.

### Example Usage: created

<!-- UsageSnippet language="php" operationID="createWebhookEndpoint" method="post" path="/v1/webhooks" example="created" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$request = new Shared\WebhookEndpointRequest(
    url: 'https://hooks.example.com/noresponse',
);

$response = $sdk->webhookEndpoints->create(
    request: $request
);

if ($response->webhookEndpointCreated !== null) {
    // handle response
}
```
### Example Usage: detailed

<!-- UsageSnippet language="php" operationID="createWebhookEndpoint" method="post" path="/v1/webhooks" example="detailed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$request = new Shared\WebhookEndpointRequest(
    url: 'https://hooks.example.com:8443/noresponse/detailed',
    responseMode: Shared\ResponseMode::Detailed,
);

$response = $sdk->webhookEndpoints->create(
    request: $request
);

if ($response->webhookEndpointCreated !== null) {
    // handle response
}
```
### Example Usage: standard

<!-- UsageSnippet language="php" operationID="createWebhookEndpoint" method="post" path="/v1/webhooks" example="standard" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$request = new Shared\WebhookEndpointRequest(
    url: 'https://hooks.example.com/noresponse',
);

$response = $sdk->webhookEndpoints->create(
    request: $request
);

if ($response->webhookEndpointCreated !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                      | Type                                                                           | Required                                                                       | Description                                                                    |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `$request`                                                                     | [Shared\WebhookEndpointRequest](../../Models/Shared/WebhookEndpointRequest.md) | :heavy_check_mark:                                                             | The request object to use for the request.                                     |

### Response

**[?Operations\CreateWebhookEndpointResponse](../../Models/Operations/CreateWebhookEndpointResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## delete

Deletes the endpoint and its signing keys. Deliveries still queued for it are dropped. Requires the webhooks scope. An endpoint that is already gone answers 404.

### Example Usage

<!-- UsageSnippet language="php" operationID="deleteWebhookEndpoint" method="delete" path="/v1/webhooks/{endpoint_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->webhookEndpoints->delete(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  | Example                                                                                      |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `endpointId`                                                                                 | *string*                                                                                     | :heavy_check_mark:                                                                           | The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404. | whe_01JA2ZD0E1F2G3H4J5K6M7N8P9                                                               |

### Response

**[?Operations\DeleteWebhookEndpointResponse](../../Models/Operations/DeleteWebhookEndpointResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## rotateSigningKey

Issues a new signing key for the endpoint and returns its secret once. Every delivery from now on is signed with it; the key it replaces keeps verifying for 7 days, so your receiver can hold both while it switches. Requires the webhooks scope. Rotation is not idempotent: a retry after a lost answer issues another key, which replaces the first.

### Example Usage: empty

<!-- UsageSnippet language="php" operationID="rotateWebhookSigningKey" method="post" path="/v1/webhooks/{endpoint_id}/rotate" example="empty" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookKeyRotationRequest();

$response = $sdk->webhookEndpoints->rotateSigningKey(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    body: $body

);

if ($response->webhookKeyRotation !== null) {
    // handle response
}
```
### Example Usage: rotated

<!-- UsageSnippet language="php" operationID="rotateWebhookSigningKey" method="post" path="/v1/webhooks/{endpoint_id}/rotate" example="rotated" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookKeyRotationRequest();

$response = $sdk->webhookEndpoints->rotateSigningKey(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    body: $body

);

if ($response->webhookKeyRotation !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  | Example                                                                                      |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `endpointId`                                                                                 | *string*                                                                                     | :heavy_check_mark:                                                                           | The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404. | whe_01JA2ZD0E1F2G3H4J5K6M7N8P9                                                               |
| `body`                                                                                       | [Shared\WebhookKeyRotationRequest](../../Models/Shared/WebhookKeyRotationRequest.md)         | :heavy_check_mark:                                                                           | N/A                                                                                          |                                                                                              |

### Response

**[?Operations\RotateWebhookSigningKeyResponse](../../Models/Operations/RotateWebhookSigningKeyResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## sendTestEvent

endpoint.verification sends a signed challenge now and answers whether the endpoint echoed it within 5 seconds; an echo verifies the endpoint, including a disabled one. assessment.updated queues one signed event with test: true and a fixed example assessment in the endpoint's response mode, delivered and retried like any other event; the endpoint must be verified. Both use the endpoint's current signing key. Requires the webhooks scope.

### Example Usage: assessment_updated

<!-- UsageSnippet language="php" operationID="sendWebhookTestEvent" method="post" path="/v1/webhooks/{endpoint_id}/test" example="assessment_updated" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookTestRequest(
    event: Shared\WebhookTestRequestEvent::AssessmentUpdated,
);

$response = $sdk->webhookEndpoints->sendTestEvent(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    body: $body

);

if ($response->webhookTest !== null) {
    // handle response
}
```
### Example Usage: verification

<!-- UsageSnippet language="php" operationID="sendWebhookTestEvent" method="post" path="/v1/webhooks/{endpoint_id}/test" example="verification" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookTestRequest(
    event: Shared\WebhookTestRequestEvent::EndpointVerification,
);

$response = $sdk->webhookEndpoints->sendTestEvent(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    body: $body

);

if ($response->webhookTest !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  | Example                                                                                      |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `endpointId`                                                                                 | *string*                                                                                     | :heavy_check_mark:                                                                           | The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404. | whe_01JA2ZD0E1F2G3H4J5K6M7N8P9                                                               |
| `body`                                                                                       | [Shared\WebhookTestRequest](../../Models/Shared/WebhookTestRequest.md)                       | :heavy_check_mark:                                                                           | N/A                                                                                          |                                                                                              |

### Response

**[?Operations\SendWebhookTestEventResponse](../../Models/Operations/SendWebhookTestEventResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## listDeliveries

Every POST the endpoint received, newest first: the event id and type, which attempt it was, whether it was a replay, delivered or failed, the response code, why it failed and how long it took. Attempts are kept for 30 days, or your retention_days when that is shorter, and are deleted with the assessment they carried. Requires the webhooks scope. Read-only and safe to retry. The cursor is opaque and bound to your workspace and the endpoint; a tampered or expired cursor answers 400 invalid_cursor.

### Example Usage

<!-- UsageSnippet language="php" operationID="listWebhookDeliveries" method="get" path="/v1/webhooks/{endpoint_id}/deliveries" example="attempts" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$responses = $sdk->webhookEndpoints->listDeliveries(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    limit: 20

);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                                                    | Type                                                                                         | Required                                                                                     | Description                                                                                  | Example                                                                                      |
| -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------- |
| `endpointId`                                                                                 | *string*                                                                                     | :heavy_check_mark:                                                                           | The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404. | whe_01JA2ZD0E1F2G3H4J5K6M7N8P9                                                               |
| `limit`                                                                                      | *?int*                                                                                       | :heavy_minus_sign:                                                                           | Attempts per page.                                                                           |                                                                                              |
| `cursor`                                                                                     | *?string*                                                                                    | :heavy_minus_sign:                                                                           | next_cursor from the previous page, unchanged.                                               |                                                                                              |

### Response

**[?Operations\ListWebhookDeliveriesResponse](../../Models/Operations/ListWebhookDeliveriesResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## replayDelivery

Queues the event for the endpoint again: the same event id and body it received, with a new NR-Webhook-Timestamp and a signature from the endpoint's current signing key, retried like any other delivery and listed with replay: true. Your receiver deduplicates on the event id. The endpoint must be verified. Requires the webhooks scope. Not idempotent: each call, a retry included, sends the event again.

### Example Usage: empty

<!-- UsageSnippet language="php" operationID="replayWebhookDelivery" method="post" path="/v1/webhooks/{endpoint_id}/deliveries/{event_id}/replay" example="empty" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookReplayRequest();

$response = $sdk->webhookEndpoints->replayDelivery(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    eventId: 'evt_01JA2ZD3K4M5N6P7Q8R9S0T1V2',
    body: $body

);

if ($response->webhookReplay !== null) {
    // handle response
}
```
### Example Usage: replay

<!-- UsageSnippet language="php" operationID="replayWebhookDelivery" method="post" path="/v1/webhooks/{endpoint_id}/deliveries/{event_id}/replay" example="replay" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\WebhookReplayRequest();

$response = $sdk->webhookEndpoints->replayDelivery(
    endpointId: 'whe_01JA2ZD0E1F2G3H4J5K6M7N8P9',
    eventId: 'evt_01JA2ZD3K4M5N6P7Q8R9S0T1V2',
    body: $body

);

if ($response->webhookReplay !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                                                                                   | Type                                                                                                                                                                                                                        | Required                                                                                                                                                                                                                    | Description                                                                                                                                                                                                                 | Example                                                                                                                                                                                                                     |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `endpointId`                                                                                                                                                                                                                | *string*                                                                                                                                                                                                                    | :heavy_check_mark:                                                                                                                                                                                                          | The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404.                                                                                                                                | whe_01JA2ZD0E1F2G3H4J5K6M7N8P9                                                                                                                                                                                              |
| `eventId`                                                                                                                                                                                                                   | *string*                                                                                                                                                                                                                    | :heavy_check_mark:                                                                                                                                                                                                          | The evt_ id of a delivery the endpoint's log holds, as GET /v1/webhooks/{endpoint_id}/deliveries lists it. An id that is malformed, not sent to this endpoint, past the log's retention or another workspace's answers 404. | evt_01JA2ZD3K4M5N6P7Q8R9S0T1V2                                                                                                                                                                                              |
| `body`                                                                                                                                                                                                                      | [Shared\WebhookReplayRequest](../../Models/Shared/WebhookReplayRequest.md)                                                                                                                                                  | :heavy_check_mark:                                                                                                                                                                                                          | N/A                                                                                                                                                                                                                         |                                                                                                                                                                                                                             |

### Response

**[?Operations\ReplayWebhookDeliveryResponse](../../Models/Operations/ReplayWebhookDeliveryResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |