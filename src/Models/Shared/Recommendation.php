<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The recommended action: allow, step_up or review. Your application applies it. */
enum Recommendation: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
}
