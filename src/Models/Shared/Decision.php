<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The decision of the assessment's latest stored revision: block when its stored risk.block is true, otherwise its recommendation. This is not the account's current decision or held-admission state. Combined with recommendation using AND. */
enum Decision: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
    case Block = 'block';
}
