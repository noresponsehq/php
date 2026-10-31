<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 409 answer can carry. */
enum ConflictErrorCode: string
{
    case IdempotencyKeyReused = 'idempotency_key_reused';
    case KeyRotationInProgress = 'key_rotation_in_progress';
    case WebhookEndpointLimitReached = 'webhook_endpoint_limit_reached';
    case WebhookEndpointUnverified = 'webhook_endpoint_unverified';
    case TooManyIntegrations = 'too_many_integrations';
    case RiskVersionAhead = 'risk_version_ahead';
    case KeyLimitReached = 'key_limit_reached';
    case SelfRevocation = 'self_revocation';
    case OutcomeConflict = 'outcome_conflict';
    case CredentialConflict = 'credential_conflict';
    case BindingConflict = 'binding_conflict';
    case ListEntryExists = 'list_entry_exists';
    case ListLimitReached = 'list_limit_reached';
    case ListEntryTooBroad = 'list_entry_too_broad';
    case PolicyVersionConflict = 'policy_version_conflict';
    case ReviewVersionConflict = 'review_version_conflict';
    case ReviewExists = 'review_exists';
    case ReviewLimitReached = 'review_limit_reached';
    case ExportConflict = 'export_conflict';
    case EvaluationConflict = 'evaluation_conflict';
    case EvaluationNoProposal = 'evaluation_no_proposal';
    case EvaluationLimitReached = 'evaluation_limit_reached';
    case AlreadyMember = 'already_member';
    case MemberLimitReached = 'member_limit_reached';
    case AggregateErasedData = 'aggregate_erased_data';
}
