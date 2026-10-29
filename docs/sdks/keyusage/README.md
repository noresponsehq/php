# KeyUsage

## Overview

Usage of keys issued to your accounts.

### Available Operations

* [record](#record) - Report requests made with API keys your platform issued.

## record

Records requests made with API keys your platform issued to your accounts, one event per request: the key's SHA-256 (the issued_credential.sha256 the account's assessment carried), the client IP, the time and optionally the user agent, model and token counts. Most callers use the SDK's usage buffer, which batches events and sends them in the background. Sampling is allowed: sample_rate weights an event's request and token counts. Requires the assess scope. Idempotency-Key is optional in the SDK and handled as on POST /v1/assessments: a retry with the same key and body answers the same record with Idempotent-Replayed: true and counts nothing again; a different body answers 409. A batch holds 1 to 500 events and at most 256 KiB. No raw event is kept: usage is aggregated per key, and IPs, user agents and models are kept only as keyed digests, with the IP's country, for 24 hours. When one key is used from 20 or more IP addresses, or 3 or more countries, within 24 hours, every account whose assessment carried that key gets the shared_api_key reason for 30 days.

### Example Usage: batch

<!-- UsageSnippet language="php" operationID="recordKeyUsage" method="post" path="/v1/key_usage/batches" example="batch" -->
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

$body = new Shared\KeyUsageBatchRequest(
    events: [
        new Shared\KeyUsageEvent(
            keySha256: '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',
            ip: '203.0.113.24',
            occurredAt: '2026-10-23T09:14:07Z',
            userAgent: 'python-requests/2.32.3',
            model: 'gpt-4o-mini',
            inputTokens: 812,
            outputTokens: 164,
        ),
        new Shared\KeyUsageEvent(
            keySha256: '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08',
            ip: '2001:db8:4a::17',
            occurredAt: '2026-10-23T09:14:09.250Z',
            sampleRate: 0.25,
        ),
    ],
);

$response = $sdk->keyUsage->record(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: recorded

<!-- UsageSnippet language="php" operationID="recordKeyUsage" method="post" path="/v1/key_usage/batches" example="recorded" -->
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

$body = new Shared\KeyUsageBatchRequest(
    events: [],
);

$response = $sdk->keyUsage->record(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `body`                                                                                                                                                                                                                                                                   | [Shared\KeyUsageBatchRequest](../../Models/Shared/KeyUsageBatchRequest.md)                                                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      |                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                       | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | account-acct_7f3a9c                                                                                                                                                                                                                                                      |

### Response

**[?Operations\RecordKeyUsageResponse](../../Models/Operations/RecordKeyUsageResponse.md)**

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