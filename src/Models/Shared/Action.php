<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Action: string
{
    case Allow = 'allow';
    case Block = 'block';
}
