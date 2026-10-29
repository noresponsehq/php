<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Customer-submitted input. It does not mean the customer or NoResponse verified ownership. */
enum Provenance: string
{
    case Submitted = 'submitted';
}
