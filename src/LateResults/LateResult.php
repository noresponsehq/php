<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use NoResponse\Models\Shared\AccountDeletedEvent;
use NoResponse\Models\Shared\AccountRiskChangedEvent;
use NoResponse\Models\Shared\AssessmentUpdatedEvent;
use NoResponse\Models\Shared\EndpointVerificationEvent;
use NoResponse\Models\Shared\WebhookEndpointDisabledEvent;
use NoResponse\Models\Shared\WorkspaceDeletedEvent;

/**
 * The outcome of handleLateResult. event is the verified event (answer an
 * EndpointVerificationEvent with {"challenge": $event->data->challenge}).
 * action is the action that ran: "none" when the policy, the event or the user id
 * called for nothing. It can be stronger than the policy's action when the
 * provider had to fall back: Auth0Provider reports "ban" when it blocked the
 * user because the tenant's plan cannot end sessions. userId is the
 * provider user id acted on, set only when an action was taken.
 */
final class LateResult
{
    public function __construct(
        public readonly AssessmentUpdatedEvent|EndpointVerificationEvent|AccountDeletedEvent|WorkspaceDeletedEvent|WebhookEndpointDisabledEvent|AccountRiskChangedEvent $event,
        public readonly string $action,
        public readonly ?string $userId = null,
    ) {
    }
}
