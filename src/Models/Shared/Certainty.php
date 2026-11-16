<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** confirmed: a linked record or the searched identifier states it directly. likely: a strong inference. possible: a weak inference. */
enum Certainty: string
{
    case Confirmed = 'confirmed';
    case Likely = 'likely';
    case Possible = 'possible';
}
