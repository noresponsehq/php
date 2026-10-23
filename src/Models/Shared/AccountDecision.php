<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** block when the score reached your block threshold (risk.block of the assessment), otherwise the assessment's recommendation. Your application applies it. */
enum AccountDecision: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
    case Block = 'block';
}
