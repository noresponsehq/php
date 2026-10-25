<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator. */
enum KeyEnvironment: string
{
    case Live = 'live';
    case Test = 'test';
}
