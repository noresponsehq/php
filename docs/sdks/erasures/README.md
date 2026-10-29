# Erasures

## Overview

Durable deletion receipts.

### Available Operations

* [get](#get) - Read an erasure receipt

## get

Read retained erasure progress and downstream acknowledgements. Completion does not certify deletion from backups.

### Example Usage

<!-- UsageSnippet language="php" operationID="getErasureReceipt" method="get" path="/v1/erasures/{erasure_id}" example="receipt" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->erasures->get(
    erasureId: '<id>'
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter          | Type               | Required           | Description        |
| ------------------ | ------------------ | ------------------ | ------------------ |
| `erasureId`        | *string*           | :heavy_check_mark: | N/A                |

### Response

**[?Operations\GetErasureReceiptResponse](../../Models/Operations/GetErasureReceiptResponse.md)**

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