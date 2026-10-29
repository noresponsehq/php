# Assessments

## Overview

Assessments of account creation, login and purchase.

### Available Operations

* [create](#create) - Assess identifiers for a signup or gateway decision.
* [get](#get) - Poll the authoritative assessment of one assessment.
* [delete](#delete) - Delete one assessment.
* [recordOutcome](#recordoutcome) - Report what was later learned about an assessed account.
* [query](#query) - Page through one account's unexpired assessments.
* [aggregate](#aggregate) - Count assessments by time, decision and reason
* [search](#search) - Search assessments across this environment
* [retrieveVersion](#retrieveversion) - Retrieve an exact assessment revision
* [bindAccount](#bindaccount) - Bind a provisional signup account

## create

Assesses one account creation, login or purchase (flow) and answers with the account's one current risk: account.risk.decision is the decision for this flow (allow, step_up, review or block, where block means your block threshold was reached), and detail holds this assessment's own facts. depth sets how long the answer waits for sources: quick waits only for the fast ones (500 ms), full for the whole budget (3000 ms at most); it defaults to full for account_creation and purchase and quick for login. 200 carries complete or partial, 202 carries pending with Location and Retry-After. While the account's first assessment is pending, account is absent: apply your own fallback for that, 429, 503 or a timeout. NoResponse blocks nothing itself; you decide. Requires the assess scope. Idempotency-Key is optional in the SDK and is bound to the body for 24 hours: the same key with the same body replays the latest assessment with Idempotent-Replayed: true and starts no new work; the same key with a different body answers 409 idempotency_key_reused. response_mode defaults to standard; detailed needs the detailed scope. The answer leaves out detail.identifiers: you hold what you sent, and a key with the history scope gets them back with GET.

### Example Usage: complete

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="complete" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new.user',
        phone: '+61412345678',
        name: 'Alex Example',
        ip: '203.0.113.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'AU',
    ),
    requestId: 'req-2026-10-14-0001',
    clientContext: new Shared\AssessmentRequestClientContext(
        timezone: 'Australia/Sydney',
        locale: 'en-AU',
        appVersion: '4.12.0',
        userAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0 Safari/537.36',
        deviceId: 'dev_5c1e8a',
        sessionId: 'sess_9b2d41',
        clientObservedAt: '2026-10-14T08:59:58.000Z',
    ),
    authContext: new Shared\AuthContext(
        provider: 'clerk',
        issuer: 'https://example-app.clerk.accounts.dev',
        audience: 'https://app.example.com',
        audiences: [
            'https://app.example.com',
        ],
        subject: 'user_2EXAMPLE',
        sessionId: 'sess_2EXAMPLE',
        organizationId: 'org_2EXAMPLE',
        tenantId: 'tenant_2EXAMPLE',
        tokenId: '2EXAMPLEJTI',
        issuedAt: '2026-10-14T08:59:40.000Z',
        expiresAt: '2026-10-14T09:00:40.000Z',
        sessionCreatedAt: '2026-10-14T08:57:00.000Z',
        authTime: '2026-10-14T08:55:00.000Z',
        accountCreatedAt: '2026-10-14T08:56:00.000Z',
        verified: false,
        mfa: new Shared\AuthContextMfa(
            methods: [
                'totp',
            ],
        ),
        roles: [
            'admin',
        ],
        scopes: [
            'org:sys_profile:manage',
        ],
    ),
    issuedCredential: new Shared\AssessmentRequestIssuedCredential(
        sha256: '2bdbf5c72f2a36df0ef40fb92203612274d4546f56dba946070a6a79c2401a1b',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: detailed

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="detailed" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new.user',
        phone: '+61412345678',
        name: 'Alex Example',
        ip: '203.0.113.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'AU',
    ),
    requestId: 'req-2026-10-14-0001',
    clientContext: new Shared\AssessmentRequestClientContext(
        timezone: 'Australia/Sydney',
        locale: 'en-AU',
        appVersion: '4.12.0',
        userAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0 Safari/537.36',
        deviceId: 'dev_5c1e8a',
        sessionId: 'sess_9b2d41',
        clientObservedAt: '2026-10-14T08:59:58.000Z',
    ),
    authContext: new Shared\AuthContext(
        provider: 'clerk',
        issuer: 'https://example-app.clerk.accounts.dev',
        audience: 'https://app.example.com',
        audiences: [
            'https://app.example.com',
        ],
        subject: 'user_2EXAMPLE',
        sessionId: 'sess_2EXAMPLE',
        organizationId: 'org_2EXAMPLE',
        tenantId: 'tenant_2EXAMPLE',
        tokenId: '2EXAMPLEJTI',
        issuedAt: '2026-10-14T08:59:40.000Z',
        expiresAt: '2026-10-14T09:00:40.000Z',
        sessionCreatedAt: '2026-10-14T08:57:00.000Z',
        authTime: '2026-10-14T08:55:00.000Z',
        accountCreatedAt: '2026-10-14T08:56:00.000Z',
        verified: false,
        mfa: new Shared\AuthContextMfa(
            methods: [
                'totp',
            ],
        ),
        roles: [
            'admin',
        ],
        scopes: [
            'org:sys_profile:manage',
        ],
    ),
    issuedCredential: new Shared\AssessmentRequestIssuedCredential(
        sha256: '2bdbf5c72f2a36df0ef40fb92203612274d4546f56dba946070a6a79c2401a1b',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: full

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="full" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new_user_42',
        phone: '+447700900123',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'GB',
    ),
    requestId: 'req-2026-10-14-0001',
    deadlineMs: 300,
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: login

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="login" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new.user',
        phone: '+61412345678',
        name: 'Alex Example',
        ip: '203.0.113.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'AU',
    ),
    requestId: 'req-2026-10-14-0001',
    clientContext: new Shared\AssessmentRequestClientContext(
        timezone: 'Australia/Sydney',
        locale: 'en-AU',
        appVersion: '4.12.0',
        userAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0 Safari/537.36',
        deviceId: 'dev_5c1e8a',
        sessionId: 'sess_9b2d41',
        clientObservedAt: '2026-10-14T08:59:58.000Z',
    ),
    authContext: new Shared\AuthContext(
        provider: 'clerk',
        issuer: 'https://example-app.clerk.accounts.dev',
        audience: 'https://app.example.com',
        audiences: [
            'https://app.example.com',
        ],
        subject: 'user_2EXAMPLE',
        sessionId: 'sess_2EXAMPLE',
        organizationId: 'org_2EXAMPLE',
        tenantId: 'tenant_2EXAMPLE',
        tokenId: '2EXAMPLEJTI',
        issuedAt: '2026-10-14T08:59:40.000Z',
        expiresAt: '2026-10-14T09:00:40.000Z',
        sessionCreatedAt: '2026-10-14T08:57:00.000Z',
        authTime: '2026-10-14T08:55:00.000Z',
        accountCreatedAt: '2026-10-14T08:56:00.000Z',
        verified: false,
        mfa: new Shared\AuthContextMfa(
            methods: [
                'totp',
            ],
        ),
        roles: [
            'admin',
        ],
        scopes: [
            'org:sys_profile:manage',
        ],
    ),
    issuedCredential: new Shared\AssessmentRequestIssuedCredential(
        sha256: '2bdbf5c72f2a36df0ef40fb92203612274d4546f56dba946070a6a79c2401a1b',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: minimal

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="minimal" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: name_and_ip

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="name_and_ip" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_8412',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'jane.doe@example.com',
        username: 'janedoe',
        phone: '+14155550123',
        name: 'Jane A. Doe',
        ip: '73.162.18.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'US',
    ),
    requestId: 'req_01',
    deadlineMs: 500,
    responseMode: Shared\ResponseMode::Standard,
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: partial

<!-- UsageSnippet language="php" operationID="createAssessment" method="post" path="/v1/assessments" example="partial" -->
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

$body = new Shared\AssessmentRequest(
    accountId: 'acct_7f3a9c',
    flow: Shared\Flow::AccountCreation,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
        username: 'new.user',
        phone: '+61412345678',
        name: 'Alex Example',
        ip: '203.0.113.45',
    ),
    policyContext: new Shared\AssessmentRequestPolicyContext(
        region: 'AU',
    ),
    requestId: 'req-2026-10-14-0001',
    clientContext: new Shared\AssessmentRequestClientContext(
        timezone: 'Australia/Sydney',
        locale: 'en-AU',
        appVersion: '4.12.0',
        userAgent: 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0 Safari/537.36',
        deviceId: 'dev_5c1e8a',
        sessionId: 'sess_9b2d41',
        clientObservedAt: '2026-10-14T08:59:58.000Z',
    ),
    authContext: new Shared\AuthContext(
        provider: 'clerk',
        issuer: 'https://example-app.clerk.accounts.dev',
        audience: 'https://app.example.com',
        audiences: [
            'https://app.example.com',
        ],
        subject: 'user_2EXAMPLE',
        sessionId: 'sess_2EXAMPLE',
        organizationId: 'org_2EXAMPLE',
        tenantId: 'tenant_2EXAMPLE',
        tokenId: '2EXAMPLEJTI',
        issuedAt: '2026-10-14T08:59:40.000Z',
        expiresAt: '2026-10-14T09:00:40.000Z',
        sessionCreatedAt: '2026-10-14T08:57:00.000Z',
        authTime: '2026-10-14T08:55:00.000Z',
        accountCreatedAt: '2026-10-14T08:56:00.000Z',
        verified: false,
        mfa: new Shared\AuthContextMfa(
            methods: [
                'totp',
            ],
        ),
        roles: [
            'admin',
        ],
        scopes: [
            'org:sys_profile:manage',
        ],
    ),
    issuedCredential: new Shared\AssessmentRequestIssuedCredential(
        sha256: '2bdbf5c72f2a36df0ef40fb92203612274d4546f56dba946070a6a79c2401a1b',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `body`                                                                                                                                                                                                                                                                   | [Shared\AssessmentRequest](../../Models/Shared/AssessmentRequest.md)                                                                                                                                                                                                     | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      |                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                       | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | account-acct_7f3a9c                                                                                                                                                                                                                                                      |

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

Returns the highest assessment_version, with the account's current risk. Requires the assess or history scope. While status is pending, or partial with a source still running, the response carries Retry-After; poll no faster than it says. Another workspace's assessment, an unknown or expired assessment and a malformed assessment_id all answer 404 not_found. response_mode=detailed needs the detailed scope. A key with the history scope also gets detail.identifiers, the identifiers the assessment was sent, exactly as received.

### Example Usage: complete

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="complete" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: detailed

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="detailed" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: login

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="login" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: partial

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="partial" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: pending

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="pending" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: pending_known_account

<!-- UsageSnippet language="php" operationID="getAssessment" method="get" path="/v1/assessments/{assessment_id}" example="pending_known_account" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->get(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       | Example                                                                                                           |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                    | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400. | asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                    |
| `responseMode`                                                                                                    | [Shared\ResponseMode\|string\|null](../../Models/Shared/ResponseMode.md)                                          | :heavy_minus_sign:                                                                                                | Optional standard or separately authorised detailed customer view; raw is rejected.                               |                                                                                                                   |

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

## delete

Deletes one assessment in the environment of your key, with its versions, evidence and outcomes and the identity-graph marks its outcomes set, and scores its account again from what remains. Afterwards the assessment answers 404 and leaves the account's history. The answer names the account and the assessment its current risk now comes from; current_assessment_id is absent when the account has no assessment with a decision left. Requires the history scope. An unknown, expired or already deleted assessment answers 404, so a repeat answers 404; to erase a whole account idempotently, use accounts.delete.

### Example Usage: last

<!-- UsageSnippet language="php" operationID="deleteAssessment" method="delete" path="/v1/assessments/{assessment_id}" example="last" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->delete(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```
### Example Usage: next

<!-- UsageSnippet language="php" operationID="deleteAssessment" method="delete" path="/v1/assessments/{assessment_id}" example="next" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->delete(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       | Example                                                                                                           |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                    | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400. | asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                    |

### Response

**[?Operations\DeleteAssessmentResponse](../../Models/Operations/DeleteAssessmentResponse.md)**

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

Records what you later learned about an assessed account: confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw your earlier report; unknown is recorded only. Outcomes are append-only and the latest one wins. Requires the assess scope. Idempotency-Key is optional in the SDK and handled as on POST /v1/assessments: a retry with the same key and body answers the same record with Idempotent-Replayed: true; a different body answers 409. An unknown, expired or foreign assessment answers 404 not_found.

### Example Usage: abuse

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="abuse" -->
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

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::ConfirmedAbuse,
    observedAt: '2026-10-20T05:00:00Z',
    externalRef: 'case-123',
    notes: 'Card testing from this account; closed by trust and safety.',
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: recorded

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="recorded" -->
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

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::Unknown,
    observedAt: '2026-10-14T09:04:30.000Z',
    externalRef: 'case-48213',
    notes: 'Chargeback filed two days after account creation.',
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```
### Example Usage: withdrawn

<!-- UsageSnippet language="php" operationID="recordAssessmentOutcome" method="post" path="/v1/assessments/{assessment_id}/outcomes" example="withdrawn" -->
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

$body = new Shared\AssessmentOutcomeRequest(
    outcome: Shared\Outcome::FalsePositive,
);

$response = $sdk->assessments->recordOutcome(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `assessmentId`                                                                                                                                                                                                                                                           | *string*                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                       | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400.                                                                                                                                                        | asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                                                                                                                           |
| `body`                                                                                                                                                                                                                                                                   | [Shared\AssessmentOutcomeRequest](../../Models/Shared/AssessmentOutcomeRequest.md)                                                                                                                                                                                       | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      |                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                       | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | account-acct_7f3a9c                                                                                                                                                                                                                                                      |

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

History is a POST with account_id in the body so an account identifier stays out of URLs and access logs. Requires the history scope. Read-only and safe to retry. Newest first, each at its latest assessment_version. An account with no assessments answers 200 with empty items. The cursor is opaque and bound to your workspace and the account; a tampered or expired cursor answers 400 invalid_cursor. response_mode=detailed needs the detailed scope. Each item's identifiers holds the identifiers its assessment was sent, exactly as received.

### Example Usage: firstPage

<!-- UsageSnippet language="php" operationID="queryAccountAssessments" method="post" path="/v1/assessments/query" example="firstPage" -->
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

$request = new Shared\AssessmentQuery(
    accountId: 'acct_7f3a9c',
);

$responses = $sdk->assessments->query(
    request: $request
);


foreach ($responses as $response) {
    $result = $response->result;
    // handle response
}
```
### Example Usage: page

<!-- UsageSnippet language="php" operationID="queryAccountAssessments" method="post" path="/v1/assessments/query" example="page" -->
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

$request = new Shared\AssessmentQuery(
    accountId: 'acct_7f3a9c',
    cursor: null,
);

$responses = $sdk->assessments->query(
    request: $request
);


foreach ($responses as $response) {
    $result = $response->result;
    // handle response
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

## aggregate

Count this environment's assessments created in [from,to) by UTC hour, or by day or week from local midnight in time_zone (an IANA name, UTC by default; at most 92 days in a zone other than UTC), grouped by up to two of decision, flow, recommendation, band, reason, lane, country, asn and list_match. Each assessment counts once, by its first answer; late results do not count it again and appear in late_flips. Optional metrics add a score histogram per flow, that histogram by the latest reported outcome, and late account decision changes. from and to start a bucket and cover at most 366 days (31 for hour buckets) inside the retention period. The filters are search's and describe the first answer: send them to search with revision first to list a cell's assessments. Counts hold no identifier, stay when an assessment or account is deleted, and report reasons by code and impact band. No Idempotency-Key.

### Example Usage

<!-- UsageSnippet language="php" operationID="aggregateAssessments" method="post" path="/v1/assessments/aggregate" -->
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

$request = new Shared\AssessmentAggregateRequest(
    from: '2026-10-19T00:00:00Z',
    to: '2026-10-26T00:00:00Z',
    bucket: Shared\Bucket::Week,
    country: 'GB',
);

$response = $sdk->assessments->aggregate(
    request: $request
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                              | Type                                                                                   | Required                                                                               | Description                                                                            |
| -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- | -------------------------------------------------------------------------------------- |
| `$request`                                                                             | [Shared\AssessmentAggregateRequest](../../Models/Shared/AssessmentAggregateRequest.md) | :heavy_check_mark:                                                                     | The request object to use for the request.                                             |

### Response

**[?Operations\AggregateAssessmentsResponse](../../Models/Operations/AggregateAssessmentsResponse.md)**

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

## search

Search retained assessments created in [from,to), over at most 366 days. Filters use each assessment decision, rather than the current account decision. Results can change between pages. Keep the assessment version to retrieve the exact decision later. Each item's detail.identifiers holds the identifiers its assessment was sent, exactly as received, and first_decision holds the decision of its first answer. email finds every assessment of the accounts that sent a mailbox, matched as lists match it. changed keeps the assessments a later revision changed. total counts every match, exactly up to 10000. This read does not require an idempotency key.

### Example Usage

<!-- UsageSnippet language="php" operationID="searchAssessments" method="post" path="/v1/assessments/search" -->
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

$request = new Shared\AssessmentSearchRequest(
    from: '2026-01-01T00:00:00Z',
    to: '2026-01-02T00:00:00Z',
    accountId: 'acct_7f3a9c',
    email: 'new.user@example.com',
    cursor: 'eyJ0IjoxNzY3MjI1NjAwMDAwMDAwLCJpIjoiYXNtX2V4YW1wbGUiLCJlIjoxNzY3MjI5MjAwfQ',
    country: 'GB',
);

$response = $sdk->assessments->search(
    request: $request
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                        | Type                                                                             | Required                                                                         | Description                                                                      |
| -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- | -------------------------------------------------------------------------------- |
| `$request`                                                                       | [Shared\AssessmentSearchRequest](../../Models/Shared/AssessmentSearchRequest.md) | :heavy_check_mark:                                                               | The request object to use for the request.                                       |

### Response

**[?Operations\SearchAssessmentsResponse](../../Models/Operations/SearchAssessmentsResponse.md)**

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

## retrieveVersion

Retrieve a retained assessment version with its original decision, policy, flow and depth. This response excludes the current account decision. Current retention and response-mode permissions still apply. detail.identifiers holds the identifiers the assessment was sent, exactly as received.

### Example Usage

<!-- UsageSnippet language="php" operationID="getAssessmentVersion" method="get" path="/v1/assessments/{assessment_id}/versions/{version}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->assessments->retrieveVersion(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    version: 849915

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       | Example                                                                                                           |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                    | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400. | asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                    |
| `version`                                                                                                         | *int*                                                                                                             | :heavy_check_mark:                                                                                                | The stored assessment_version, in canonical decimal form. An unavailable or malformed version answers 404.        |                                                                                                                   |
| `responseMode`                                                                                                    | [Shared\ResponseMode\|string\|null](../../Models/Shared/ResponseMode.md)                                          | :heavy_minus_sign:                                                                                                | Optional standard or separately authorised detailed customer view; raw is rejected.                               |                                                                                                                   |

### Response

**[?Operations\GetAssessmentVersionResponse](../../Models/Operations/GetAssessmentVersionResponse.md)**

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

## bindAccount

One-time association to an opaque stable customer account. The assessment is its natural idempotency key. Repeating the same binding returns its first receipt; a conflicting target is refused. No arbitrary account merging.

### Example Usage

<!-- UsageSnippet language="php" operationID="bindProvisionalAccount" method="post" path="/v1/assessments/{assessment_id}/bind" -->
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

$body = new Shared\AccountBindingRequest(
    accountId: 'acct_7f3a9c',
);

$response = $sdk->assessments->bindAccount(
    assessmentId: 'asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                         | Type                                                                                                              | Required                                                                                                          | Description                                                                                                       | Example                                                                                                           |
| ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- | ----------------------------------------------------------------------------------------------------------------- |
| `assessmentId`                                                                                                    | *string*                                                                                                          | :heavy_check_mark:                                                                                                | Path segment, matched case-sensitively. A value that does not match the assessment_id shape answers 404, not 400. | asm_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                    |
| `body`                                                                                                            | [Shared\AccountBindingRequest](../../Models/Shared/AccountBindingRequest.md)                                      | :heavy_check_mark:                                                                                                | N/A                                                                                                               |                                                                                                                   |

### Response

**[?Operations\BindProvisionalAccountResponse](../../Models/Operations/BindProvisionalAccountResponse.md)**

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