<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum EventType: string
{
    case AssessmentUpdated = 'assessment.updated';
}
