# Assessments

## Overview

Signup and gateway assessments.

### Available Operations

* [create](#create) - Assess identifiers for a signup or gateway decision.
* [get](#get) - Poll the authoritative assessment of one assessment.
* [recordOutcome](#recordoutcome) - Report what was later learned about an assessed account.
* [query](#query) - Page through one account's unexpired assessments.

## create

Returns within the deadline (500 ms at most) with a complete, partial or pending assessment: 200 carries complete or partial, 202 carries pending with Location and Retry-After. A pending answer has no recommendation; apply your own fallback for pending, 429, 503 or a timeout. Requires the assess scope. Idempotency-Key is required and is bound to the body for 24 hours: the same key with the same body replays the latest assessment with Idempotent-Replayed: true and starts no new work; the same key with a different body answers 409 idempotency_key_reused. response_mode defaults to standard; detailed needs the detailed scope.

### Example Usage: complete

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="complete" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: '<id>',
    identifiers: new Shared\AssessmentRequestIdentifiers(),
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: detailed

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="detailed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: '<id>',
    identifiers: new Shared\AssessmentRequestIdentifiers(),
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: full

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="full" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new_user_42',
        phone: '+447700900123',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        flow: Shared\Flow::Signup,
        region: 'GB',
    ),
    requestId: 'req-2026-10-14-0001',
    deadlineMs: 300,
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: minimal

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="minimal" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
    ),
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: name_and_ip

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="name_and_ip" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: 'acct_8412',
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'jane.doe@example.com',
        username: 'janedoe',
        phone: '+14155550123',
        name: 'Jane A. Doe',
        ip: '73.162.18.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        flow: Shared\Flow::Signup,
        region: 'US',
    ),
    requestId: 'req_01',
    deadlineMs: 500,
    responseMode: Shared\ResponseMode::Standard,
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: partial

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="partial" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: '<id>',
    identifiers: new Shared\AssessmentRequestIdentifiers(),
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: standard

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="standard" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentRequest(
    accountId: '<id>',
    identifiers: new Shared\AssessmentRequestIdentifiers(),
);

$response = $sdk->assessments->create(
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessment !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                      | Type                                                                                                                                                           | Required                                                                                                                                                       | Description                                                                                                                                                    |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `idempotencyKey`                                                                                                                                               | *string*                                                                                                                                                       | :heavy_check_mark:                                                                                                                                             | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the tenant principal and bound to the canonical body for 24 hours. |
| `body`                                                                                                                                                         | [Shared\AssessmentRequest](../../Models/Shared/AssessmentRequest.md)                                                                                           | :heavy_check_mark:                                                                                                                                             | N/A                                                                                                                                                            |

### Response

**[?Operations\CreateAssessmentResponse](../../Models/Operations/CreateAssessmentResponse.md)**

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

Returns the highest assessment_version. Requires the assess or history scope. While status is pending, or partial with a source still running, the response carries Retry-After; poll no faster than it says. Another tenant's assessment, an unknown or expired assessment and a malformed assessment_id all answer 404 not_found. response_mode=detailed needs the detailed scope.

### Example Usage: complete

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="complete" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: '<id>'
);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: detailed

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="detailed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: '<id>'
);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: partial

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="partial" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: '<id>'
);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: pending

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="pending" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: '<id>'
);

if ($response->assessment !== null) {
    // handle response
}
```
### Example Usage: standard

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="standard" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: '<id>'
);

if ($response->assessment !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                    | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400. |
| `responseMode`                                                                                                    | [?Shared\ResponseMode](../../Models/Shared/ResponseMode.md)                                                       | :heavy_minus_sign:                                                                                                | Optional standard or separately authorised detailed customer view; raw is rejected.                               |

### Response

**[?Operations\GetAssessmentResponse](../../Models/Operations/GetAssessmentResponse.md)**

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

## recordOutcome

Records what you later learned about an assessed account: confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw your earlier report; unknown is recorded only. Outcomes are append-only and the latest one wins. Requires the assess scope. Idempotency-Key is required and handled as on POST /v1/assessments: a retry with the same key and body answers the same record with Idempotent-Replayed: true; a different body answers 409. An unknown, expired or foreign assessment answers 404 not_found.

### Example Usage: abuse

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="abuse" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::ConfirmedAbuse,
    observedAt: '2026-10-20T05:00:00Z',
    externalRef: 'case-123',
    notes: 'Card testing from this account; closed by trust and safety.',
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: '<id>',
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessmentOutcome !== null) {
    // handle response
}
```
### Example Usage: recorded

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="recorded" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::Legitimate,
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: '<id>',
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessmentOutcome !== null) {
    // handle response
}
```
### Example Usage: withdrawn

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="withdrawn" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::FalsePositive,
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: '<id>',
    idempotencyKey: '<value>',
    body: $body

);

if ($response->assessmentOutcome !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                      | Type                                                                                                                                                           | Required                                                                                                                                                       | Description                                                                                                                                                    |
| -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                                                                 | *string*                                                                                                                                                       | :heavy_check_mark:                                                                                                                                             | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400.                                              |
| `idempotencyKey`                                                                                                                                               | *string*                                                                                                                                                       | :heavy_check_mark:                                                                                                                                             | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the tenant principal and bound to the canonical body for 24 hours. |
| `body`                                                                                                                                                         | [Shared\AssessmentOutcomeRequest](../../Models/Shared/AssessmentOutcomeRequest.md)                                                                             | :heavy_check_mark:                                                                                                                                             | N/A                                                                                                                                                            |

### Response

**[?Operations\RecordAssessmentOutcomeResponse](../../Models/Operations/RecordAssessmentOutcomeResponse.md)**

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

## query

History is a POST with account_id in the body so an account identifier stays out of URLs and access logs. Requires the history scope. Read-only and safe to retry. Newest first, each at its latest assessment_version. An account with no assessments answers 200 with empty items. The cursor is opaque and bound to your tenant and the account; a tampered or expired cursor answers 400 invalid_cursor. response_mode=detailed needs the detailed scope.

### Example Usage: firstPage

<!-- UsageSnippet language="php" operationID="queryAccountAssessments" method="post" path="/v1/assessments/query" example="firstPage" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Shared\AssessmentQuery(
    accountId: 'acct_7f3a9c',
);

$responses = $sdk->assessments->query(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```
### Example Usage: page

<!-- UsageSnippet language="php" operationID="queryAccountAssessments" method="post" path="/v1/assessments/query" example="page" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponse::builder()
    ->setSecurity(
        '<YOUR_BEARER_TOKEN_HERE>'
    )
    ->build();

$request = new Shared\AssessmentQuery(
    accountId: '<id>',
);

$responses = $sdk->assessments->query(
    request: $request
);


foreach ($responses as $response) {
    if ($response->statusCode === 200) {
        // handle response
    }
}
```

### Parameters

| Parameter                                                        | Type                                                             | Required                                                         | Description                                                      |
| ---------------------------------------------------------------- | ---------------------------------------------------------------- | ---------------------------------------------------------------- | ---------------------------------------------------------------- |
| `$request`                                                       | [Shared\AssessmentQuery](../../Models/Shared/AssessmentQuery.md) | :heavy_check_mark:                                               | The request object to use for the request.                       |

### Response

**[?Operations\QueryAccountAssessmentsResponse](../../Models/Operations/QueryAccountAssessmentsResponse.md)**

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