# Requests

## Overview

Retained request diagnostics and operational summaries.

### Available Operations

* [list](#list) - Search request diagnostics
* [aggregate](#aggregate) - Summarise retained request attempts

## list

Search authenticated request attempts by time, route, status or request correlation id. The interval is at most seven days. Each attempt has a unique id and may include the exact served decision. Records are bounded best effort and exclude request bodies, secrets and source payloads. A repeated correlation id does not overwrite another attempt.

### Example Usage

<!-- UsageSnippet language="php" operationID="listRequestDiagnostics" method="get" path="/v1/requests" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Operations;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$request = new Operations\ListRequestDiagnosticsRequest(
    from: '2026-10-21T00:00:00Z',
    to: '2026-10-22T00:00:00Z',
);

$responses = $sdk->requests->list(
    request: $request
);


foreach ($responses as $response) {
    $result = $response->result;
    // handle response
}
```

### Parameters

| Parameter                                                                                            | Type                                                                                                 | Required                                                                                             | Description                                                                                          |
| ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------- |
| `$request`                                                                                           | [Operations\ListRequestDiagnosticsRequest](../../Models/Operations/ListRequestDiagnosticsRequest.md) | :heavy_check_mark:                                                                                   | The request object to use for the request.                                                           |

### Response

**[?Operations\ListRequestDiagnosticsResponse](../../Models/Operations/ListRequestDiagnosticsResponse.md)**

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

## aggregate

Count all retained matching request attempts and latency samples within seven days. Capture is best effort.

### Example Usage

<!-- UsageSnippet language="php" operationID="aggregateRequests" method="post" path="/v1/requests/aggregate" -->
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

$request = new Shared\RequestAggregateRequest(
    from: '2026-01-01T00:00:00Z',
    to: '2026-01-01T00:00:00Z',
    route: 'POST /v1/assessments',
    apiKeyId: '01JA2Z8K6Q4V7W9XBCDEFGHJKM',
);

$response = $sdk->requests->aggregate(
    request: $request
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Shared\RequestAggregateRequest](../../Models/Shared/RequestAggregateRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\AggregateRequestsResponse](../../Models/Operations/AggregateRequestsResponse.md)**

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