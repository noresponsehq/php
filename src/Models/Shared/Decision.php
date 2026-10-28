<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** An assessment's own decision: block when its stored risk.block is true, otherwise its recommendation. It is not the account's decision or held-admission state. */
enum Decision: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
    case Block = 'block';
}
