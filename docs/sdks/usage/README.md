# Usage

## Overview

Recorded usage for your environment.

### Available Operations

* [get](#get) - Read a workspace's usage.

## get

Read daily usage units for the environments you can access. These counts are unpriced.

### Example Usage

<!-- UsageSnippet language="php" operationID="getUsage" method="get" path="/v1/workspaces/{workspace_id}/usage" example="usage" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->usage->get(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                          | Type                                                                                                                               | Required                                                                                                                           | Description                                                                                                                        | Example                                                                                                                            |
| ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                      | *string*                                                                                                                           | :heavy_check_mark:                                                                                                                 | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404. | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                     |
| `from`                                                                                                                             | *?string*                                                                                                                          | :heavy_minus_sign:                                                                                                                 | The first UTC day, as YYYY-MM-DD.                                                                                                  |                                                                                                                                    |
| `to`                                                                                                                               | *?string*                                                                                                                          | :heavy_minus_sign:                                                                                                                 | The last UTC day, included, as YYYY-MM-DD; no later than today.                                                                    |                                                                                                                                    |

### Response

**[?Operations\GetUsageResponse](../../Models/Operations/GetUsageResponse.md)**

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