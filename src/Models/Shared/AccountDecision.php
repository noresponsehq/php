<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. held only for a flow whose admission is held (settings flows.<flow>.admission), when the account's current assessment was made for that flow and its investigation has not completed (status partial): the final decision arrives as account.risk_changed when the investigation completes, decided by its score, or when the hold's deadline (hold_seconds after the assessment was created) passes first, as the flow's on_expiry action or the decision the evidence so far gives, whichever is stricter. Your application applies it. */
enum AccountDecision: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
    case Block = 'block';
    case Held = 'held';
}
