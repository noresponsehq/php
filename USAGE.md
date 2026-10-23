<!-- Start SDK Example Usage [usage] -->
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
    flow: Shared\AssessmentFlow::Signup,
    identifiers: new Shared\AssessmentRequestIdentifiers(
        email: 'new.user@example.com',
    ),
);

$response = $sdk->assessments->create(
    body: $body,
    idempotencyKey: 'signup-acct_7f3a9c'

);

if ($response->assessment !== null) {
    // handle response
}
```
<!-- End SDK Example Usage [usage] -->