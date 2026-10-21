<!-- Start SDK Example Usage [usage] -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
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
    body: $body,
    idempotencyKey: '<value>'

);

if ($response->assessment !== null) {
    // handle response
}
```
<!-- End SDK Example Usage [usage] -->