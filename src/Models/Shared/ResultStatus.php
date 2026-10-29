<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ResultStatus: string
{
    case NoChange = 'no_change';
    case ProposalRequiresReview = 'proposal_requires_review';
}
