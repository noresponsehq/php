# Investigations

## Overview

Person investigation jobs, retained results and contextual decisions.

### Available Operations

* [list](#list) - List investigation history.
* [create](#create) - Start an investigation for a person.
* [get](#get) - Read an investigation and its evidence.
* [review](#review) - Record an investigation decision.
* [cancel](#cancel) - Cancel an investigation

## list

List investigation history. The API key determines the workspace and environment.

### Example Usage

<!-- UsageSnippet language="php" operationID="listInvestigations" method="get" path="/v1/investigations" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->investigations->list(
    limit: 100
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter          | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `personId`         | *?string*          | :heavy_minus_sign: | N/A                |
| `before`           | *?string*          | :heavy_minus_sign: | N/A                |
| `limit`            | *?int*             | :heavy_minus_sign: | N/A                |

### Response

**[?Operations\ListInvestigationsResponse](../../Models/Operations/ListInvestigationsResponse.md)**

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

Starts an investigation against a retained workspace person, independently of group membership. enrichment overrides, field by field, how the environment's enrichment setting runs after this investigation; the person's latest investigation decides the enrichment that runs on them. Idempotency-Key is required: the same key and input return the same retained job in its current state without repeating billable work. Different input with that key answers 409 idempotency_key_reused; a deliberate new investigation uses a new key. The response includes Location and Retry-After. The person's retention expiry limits both execution and retained history. The API key selects the workspace and environment.

### Example Usage

<!-- UsageSnippet language="php" operationID="createInvestigation" method="post" path="/v1/investigations" -->
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

$body = new Shared\InvestigationRequest(
    depth: Shared\ScreeningDepth::Standard,
    personId: 'per_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
);

$response = $sdk->investigations->create(
    body: $body,
    idempotencyKey: 'investigation-case-1042-first'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                                                                                                                                                                                                       | Type                                                                                                                                                                                                                                                                                                                                                                                                                                                            | Required                                                                                                                                                                                                                                                                                                                                                                                                                                                        | Description                                                                                                                                                                                                                                                                                                                                                                                                                                                     | Example                                                                                                                                                                                                                                                                                                                                                                                                                                                         |
| --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- | --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `body`                                                                                                                                                                                                                                                                                                                                                                                                                                                          | [Shared\InvestigationRequest](../../Models/Shared/InvestigationRequest.md)                                                                                                                                                                                                                                                                                                                                                                                      | :heavy_check_mark:                                                                                                                                                                                                                                                                                                                                                                                                                                              | N/A                                                                                                                                                                                                                                                                                                                                                                                                                                                             |                                                                                                                                                                                                                                                                                                                                                                                                                                                                 |
| `idempotencyKey`                                                                                                                                                                                                                                                                                                                                                                                                                                                | *?string*                                                                                                                                                                                                                                                                                                                                                                                                                                                       | :heavy_minus_sign:                                                                                                                                                                                                                                                                                                                                                                                                                                              | Opaque request key, 16 to 128 characters. Repeating the key and request returns the same resource in its current state while it is retained. A different request with the same key answers 409. Use a new key for a deliberate new operation. Keys are scoped to the environment and operation; person searches also scope them to the group and person. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | investigation-case-1042-first                                                                                                                                                                                                                                                                                                                                                                                                                                   |

### Response

**[?Operations\CreateInvestigationResponse](../../Models/Operations/CreateInvestigationResponse.md)**

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

## get

Returns this investigation's status, coverage, source records, posts, media and contextual review history. Full evidence is returned by default; explicit evidence.read denial keeps submitted person details, status, coverage and decision summaries and hides collected evidence and free-text notes. The read is durably audited as person.viewed. The API key selects the workspace and environment. Missing, foreign or expired results answer 404.

### Example Usage

<!-- UsageSnippet language="php" operationID="getInvestigation" method="get" path="/v1/investigations/{investigation_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->investigations->get(
    investigationId: 'inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                      | Type                           | Required                       | Description                    | Example                        |
| ------------------------------ | ------------------------------ | ------------------------------ | ------------------------------ | ------------------------------ |
| `investigationId`              | *string*                       | :heavy_check_mark:             | N/A                            | inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM |

### Response

**[?Operations\GetInvestigationResponse](../../Models/Operations/GetInvestigationResponse.md)**

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

## review

Record an investigation decision. Deprecated: decisions are leaving people and groups. The console no longer records them and no screening reads them. This route is removed in the next contract release; stop calling it. The API key determines the workspace and environment.

### Example Usage

<!-- UsageSnippet language="php" operationID="reviewInvestigation" method="post" path="/v1/investigations/{investigation_id}/reviews" -->
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

$body = new Shared\PersonReviewRequest(
    decision: Shared\PersonDecision::Watch,
    note: 'Known to the venue team.',
);

$response = $sdk->investigations->review(
    investigationId: 'inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                | Type                                                                     | Required                                                                 | Description                                                              | Example                                                                  |
| ------------------------------------------------------------------------ | ------------------------------------------------------------------------ | ------------------------------------------------------------------------ | ------------------------------------------------------------------------ | ------------------------------------------------------------------------ |
| `investigationId`                                                        | *string*                                                                 | :heavy_check_mark:                                                       | N/A                                                                      | inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                           |
| `body`                                                                   | [Shared\PersonReviewRequest](../../Models/Shared/PersonReviewRequest.md) | :heavy_check_mark:                                                       | N/A                                                                      |                                                                          |

### Response

**[?Operations\ReviewInvestigationResponse](../../Models/Operations/ReviewInvestigationResponse.md)**

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

## cancel

Stops this investigation. A completed or already cancelled investigation keeps its current result. Other investigations for the person keep running.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancelInvestigation" method="post" path="/v1/investigations/{investigation_id}/cancel" -->
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

$body = new Shared\ScreeningCancelRequest();

$response = $sdk->investigations->cancel(
    investigationId: 'inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                      | Type                                                                           | Required                                                                       | Description                                                                    | Example                                                                        |
| ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ | ------------------------------------------------------------------------------ |
| `investigationId`                                                              | *string*                                                                       | :heavy_check_mark:                                                             | N/A                                                                            | inv_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                 |
| `body`                                                                         | [Shared\ScreeningCancelRequest](../../Models/Shared/ScreeningCancelRequest.md) | :heavy_check_mark:                                                             | N/A                                                                            |                                                                                |

### Response

**[?Operations\CancelInvestigationResponse](../../Models/Operations/CancelInvestigationResponse.md)**

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