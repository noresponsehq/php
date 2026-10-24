# WebhookEvent

The body of every webhook delivery: {id, type, created_at, data}, where type chooses the shape of data. Deliveries are at least once and unordered: deduplicate on id, and keep an assessment only when its detail.assessment_version is newer than the one you hold. GET /v1/assessments/{assessment_id} stays authoritative.


## Supported Types

### `Shared\AssessmentUpdatedEvent`

```php
/**
* @var \NoResponse\Models\Shared\AssessmentUpdatedEvent
*/
Shared\AssessmentUpdatedEvent $value = /* values here */
```

### `Shared\EndpointVerificationEvent`

```php
/**
* @var \NoResponse\Models\Shared\EndpointVerificationEvent
*/
Shared\EndpointVerificationEvent $value = /* values here */
```

### `Shared\AccountDeletedEvent`

```php
/**
* @var \NoResponse\Models\Shared\AccountDeletedEvent
*/
Shared\AccountDeletedEvent $value = /* values here */
```

### `Shared\WorkspaceDeletedEvent`

```php
/**
* @var \NoResponse\Models\Shared\WorkspaceDeletedEvent
*/
Shared\WorkspaceDeletedEvent $value = /* values here */
```

### `Shared\WebhookEndpointDisabledEvent`

```php
/**
* @var \NoResponse\Models\Shared\WebhookEndpointDisabledEvent
*/
Shared\WebhookEndpointDisabledEvent $value = /* values here */
```

### `Shared\AccountRiskChangedEvent`

```php
/**
* @var \NoResponse\Models\Shared\AccountRiskChangedEvent
*/
Shared\AccountRiskChangedEvent $value = /* values here */
```

