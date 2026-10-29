<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 429 answer can carry. */
enum RateLimitErrorCode: string
{
    case RateLimited = 'rate_limited';
    case AssessmentBudgetExhausted = 'assessment_budget_exhausted';
    case ExportLimitReached = 'export_limit_reached';
}
