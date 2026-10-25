# Settings

## Overview

### Available Operations

* [get](#get) - Read an environment's settings.
* [update](#update) - Change an environment's settings.

## get

Reads the settings of the signing key's environment: retention in days; per flow (account_creation, login, purchase) the step_up, review and block thresholds, the default depth and the admission; and the sources the environment refuses. A flow without thresholds of its own shows account_creation's with inherits_account_creation true. Requires the management scope; the other environment answers 404 not_found. Read-only and safe to retry.

### Example Usage

<!-- UsageSnippet language="php" operationID="getSettings" method="get" path="/v1/workspaces/{workspace_id}/settings/{environment}" example="default" -->
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



$response = $sdk->settings->get(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live

);

if ($response->settings !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |

### Response

**[?Operations\GetSettingsResponse](../../Models/Operations/GetSettingsResponse.md)**

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

## update

Changes only what the body names, in one transaction: retention_days, refused_sources, and per flow step_up, review, block (null turns blocking off), default_depth, admission, hold_seconds, on_expiry, or inherits_account_creation to return login or purchase to account_creation's thresholds. After the change each flow keeps 0 < step_up < review <= 100 and block off or review <= block <= 100; a change that breaks it answers 400 naming the flow. A policy change is one new policy_version with the signing key's prefix as updated_by, and every change is recorded in the workspace's audit log with the key as its actor. Requires the management scope; the other environment answers 404 not_found. A change reaches assessments within a minute.

### Example Usage: changed

<!-- UsageSnippet language="php" operationID="updateSettings" method="patch" path="/v1/workspaces/{workspace_id}/settings/{environment}" example="changed" -->
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

$body = new Shared\SettingsRequest();

$response = $sdk->settings->update(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    body: $body

);

if ($response->settings !== null) {
    // handle response
}
```
### Example Usage: flows

<!-- UsageSnippet language="php" operationID="updateSettings" method="patch" path="/v1/workspaces/{workspace_id}/settings/{environment}" example="flows" -->
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

$body = new Shared\SettingsRequest(
    retentionDays: 90,
    refusedSources: [
        Shared\SourceId::Phone,
    ],
    flows: new Shared\SettingsRequestFlows(
        accountCreation: new Shared\FlowChange(
            admission: Shared\Admission::Held,
            holdSeconds: 600,
            onExpiry: Shared\OnExpiry::Review,
        ),
        login: new Shared\FlowChange(
            stepUp: 30,
            review: 60,
            block: null,
            defaultDepth: Shared\DefaultDepth::Full,
        ),
        purchase: new Shared\FlowChange(
            inheritsAccountCreation: true,
        ),
    ),
);

$response = $sdk->settings->update(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    body: $body

);

if ($response->settings !== null) {
    // handle response
}
```
### Example Usage: signup

<!-- UsageSnippet language="php" operationID="updateSettings" method="patch" path="/v1/workspaces/{workspace_id}/settings/{environment}" example="signup" -->
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

$body = new Shared\SettingsRequest(
    flows: new Shared\SettingsRequestFlows(
        accountCreation: new Shared\FlowChange(
            block: 95,
        ),
    ),
);

$response = $sdk->settings->update(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    body: $body

);

if ($response->settings !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `body`                                                                                                                                                                 | [Shared\SettingsRequest](../../Models/Shared/SettingsRequest.md)                                                                                                       | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    |                                                                                                                                                                        |

### Response

**[?Operations\UpdateSettingsResponse](../../Models/Operations/UpdateSettingsResponse.md)**

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