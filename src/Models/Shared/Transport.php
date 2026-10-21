<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Where the customer derived this context. Backend is the trusted integration path; browser values are treated as weak hints. */
enum Transport: string
{
    case Backend = 'backend';
    case Browser = 'browser';
}
