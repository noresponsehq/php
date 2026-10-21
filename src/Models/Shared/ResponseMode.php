<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode. */
enum ResponseMode: string
{
    case Standard = 'standard';
    case Detailed = 'detailed';
}
