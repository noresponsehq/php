# ConflictErrorCode

Machine codes an HTTP 409 answer can carry.


## Values

| Name                           | Value                          |
| ------------------------------ | ------------------------------ |
| `IdempotencyKeyReused`         | idempotency_key_reused         |
| `KeyRotationInProgress`        | key_rotation_in_progress       |
| `WebhookEndpointLimitReached`  | webhook_endpoint_limit_reached |
| `WebhookEndpointUnverified`    | webhook_endpoint_unverified    |
| `TooManyIntegrations`          | too_many_integrations          |
| `RiskVersionAhead`             | risk_version_ahead             |
| `KeyLimitReached`              | key_limit_reached              |
| `SelfRevocation`               | self_revocation                |
| `OutcomeConflict`              | outcome_conflict               |
| `CredentialConflict`           | credential_conflict            |
| `BindingConflict`              | binding_conflict               |
| `ListEntryExists`              | list_entry_exists              |
| `ListLimitReached`             | list_limit_reached             |
| `ListEntryTooBroad`            | list_entry_too_broad           |