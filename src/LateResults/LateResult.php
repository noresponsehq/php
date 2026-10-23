<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use NoResponse\Webhooks\Event;

/**
 * The outcome of handleLateResult. event is the verified event (answer an
 * endpoint.verification with Webhook::verificationResponse). action is
 * the action that ran: "none" when the policy, the event or the user id
 * called for nothing. It can be stronger than the policy's action when the
 * provider had to fall back: Auth0Provider reports "ban" when it blocked the
 * user because the tenant's plan cannot end sessions. userId is the
 * provider user id acted on, set only when an action was taken.
 */
final class LateResult
{
    public function __construct(
        public readonly Event $event,
        public readonly string $action,
        public readonly ?string $userId = null,
    ) {
    }
}
