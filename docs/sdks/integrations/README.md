# Integrations

## Overview

Hosted endpoints that answer your sign-up and sign-in hooks.

### Available Operations

* [create](#create) - Register a hosted provider integration.
* [list](#list) - List the workspace's integrations.
* [delete](#delete) - Delete an integration.
* [rotate](#rotate) - Replace an integration's secret.

## create

Registers a WorkOS, Auth0 or Supabase integration and returns its hosted endpoint, url, so a sign-up or sign-in is scored with no server of your own. For WorkOS, send the Actions signing secret from the WorkOS dashboard and point the user registration and authentication Actions at url. For Supabase, send the hook secret Supabase generates (v1,whsec_...) and set url as the Before User Created hook's HTTPS endpoint. For Auth0, the answer's secret is the shared secret of the NoResponse Auth0 Action, shown once: store it as an Action secret. hook_points defaults to every hook point the platform has (Supabase has only pre_registration); an event that is not listed is allowed without an assessment. The endpoint waits for the full assessment for at most 2.5 seconds (WorkOS, Supabase) or 4.5 seconds (Auth0), denies only when risk.block is true and allows on any failure. Requires the integrations scope; at most 10 per account. Not idempotent: a retry after a lost answer registers another integration.

### Example Usage: auth0

<!-- UsageSnippet language="php" operationID="createIntegration" method="post" path="/v1/integrations" example="auth0" -->
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

$request = new Shared\IntegrationRequest(
    platform: Shared\IntegrationPlatform::Auth0,
);

$response = $sdk->integrations->create(
    request: $request
);

if ($response->integration !== null) {
    // handle response
}
```
### Example Usage: supabase

<!-- UsageSnippet language="php" operationID="createIntegration" method="post" path="/v1/integrations" example="supabase" -->
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

$request = new Shared\IntegrationRequest(
    platform: Shared\IntegrationPlatform::Supabase,
    signingSecret: null,
);

$response = $sdk->integrations->create(
    request: $request
);

if ($response->integration !== null) {
    // handle response
}
```
### Example Usage: workos

<!-- UsageSnippet language="php" operationID="createIntegration" method="post" path="/v1/integrations" example="workos" -->
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

$request = new Shared\IntegrationRequest(
    platform: Shared\IntegrationPlatform::Workos,
    hookPoints: [
        Shared\IntegrationHookPoint::PreRegistration,
        Shared\IntegrationHookPoint::PostLogin,
    ],
    signingSecret: null,
);

$response = $sdk->integrations->create(
    request: $request
);

if ($response->integration !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                              | Type                                                                   | Required                                                               | Description                                                            |
| ---------------------------------------------------------------------- | ---------------------------------------------------------------------- | ---------------------------------------------------------------------- | ---------------------------------------------------------------------- |
| `$request`                                                             | [Shared\IntegrationRequest](../../Models/Shared/IntegrationRequest.md) | :heavy_check_mark:                                                     | The request object to use for the request.                             |

### Response

**[?Operations\CreateIntegrationResponse](../../Models/Operations/CreateIntegrationResponse.md)**

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

## list

Every integration, oldest first. Listings carry no secrets. Requires the integrations scope.

### Example Usage

<!-- UsageSnippet language="php" operationID="listIntegrations" method="get" path="/v1/integrations" example="list" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->integrations->list(

);

if ($response->integrationList !== null) {
    // handle response
}
```

### Response

**[?Operations\ListIntegrationsResponse](../../Models/Operations/ListIntegrationsResponse.md)**

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

Removes the integration and its secrets; its endpoint answers 404 from then on, so remove the Action from the provider first. Requires the integrations scope. An unknown or already deleted integration answers 404.

### Example Usage

<!-- UsageSnippet language="php" operationID="deleteIntegration" method="delete" path="/v1/integrations/{integration_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->integrations->delete(
    integrationId: 'int_01JA2Z8K6Q4V7W9XBCDEFGHJKM'
);

if ($response->statusCode === 200) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                             | Type                                                                                                                                  | Required                                                                                                                              | Description                                                                                                                           | Example                                                                                                                               |
| ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| `integrationId`                                                                                                                       | *string*                                                                                                                              | :heavy_check_mark:                                                                                                                    | Path segment, matched case-sensitively. A value that does not match the integration_id shape, or another workspace's id, answers 404. | int_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                        |

### Response

**[?Operations\DeleteIntegrationResponse](../../Models/Operations/DeleteIntegrationResponse.md)**

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

## rotate

For Auth0, send {} and the answer's secret is the new shared secret, shown once. For WorkOS, regenerate the Actions secret in the WorkOS dashboard and send it as signing_secret; for Supabase, generate a new hook secret in the Supabase dashboard and send it as signing_secret. The replaced secret is still accepted for 24 hours (previous_secret_expires_at). Requires the integrations scope. Not idempotent: a retry after a lost answer rotates again.

### Example Usage: auth0

<!-- UsageSnippet language="php" operationID="rotateIntegrationSecret" method="post" path="/v1/integrations/{integration_id}/rotate" example="auth0" -->
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

$body = new Shared\IntegrationRotationRequest();

$response = $sdk->integrations->rotate(
    integrationId: 'int_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

if ($response->integration !== null) {
    // handle response
}
```
### Example Usage: workos

<!-- UsageSnippet language="php" operationID="rotateIntegrationSecret" method="post" path="/v1/integrations/{integration_id}/rotate" example="workos" -->
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

$body = new Shared\IntegrationRotationRequest(
    signingSecret: null,
);

$response = $sdk->integrations->rotate(
    integrationId: 'int_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

if ($response->integration !== null) {
    // handle response
}
```

### Parameters

| Parameter                                                                                                                             | Type                                                                                                                                  | Required                                                                                                                              | Description                                                                                                                           | Example                                                                                                                               |
| ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------- |
| `integrationId`                                                                                                                       | *string*                                                                                                                              | :heavy_check_mark:                                                                                                                    | Path segment, matched case-sensitively. A value that does not match the integration_id shape, or another workspace's id, answers 404. | int_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                        |
| `body`                                                                                                                                | [Shared\IntegrationRotationRequest](../../Models/Shared/IntegrationRotationRequest.md)                                                | :heavy_check_mark:                                                                                                                    | N/A                                                                                                                                   |                                                                                                                                       |

### Response

**[?Operations\RotateIntegrationSecretResponse](../../Models/Operations/RotateIntegrationSecretResponse.md)**

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