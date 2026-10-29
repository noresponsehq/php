<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ListImpactTransitionFrom: string
{
    case None = 'none';
    case Allow = 'allow';
    case Block = 'block';
}
