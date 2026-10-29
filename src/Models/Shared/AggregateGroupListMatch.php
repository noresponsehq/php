<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** The list action captured with the first answer. none means no matching entry was found. For retained_first_answers an absent field means the older assessment did not capture list state; this remains a separate group. */
enum AggregateGroupListMatch: string
{
    case Block = 'block';
    case Allow = 'allow';
    case None = 'none';
}
