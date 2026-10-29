<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum FromT: string
{
    case Allow = 'allow';
    case StepUp = 'step_up';
    case Review = 'review';
    case Block = 'block';
    case Held = 'held';
}
