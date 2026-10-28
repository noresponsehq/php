<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum AssessmentAggregateRequestMetric: string
{
    case Count = 'count';
    case ScoreHistogram = 'score_histogram';
    case ScoreOutcomes = 'score_outcomes';
    case LateFlips = 'late_flips';
}
