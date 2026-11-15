<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReviewInvestigationRequest
{
    /**
     *
     * @var string $investigationId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=investigation_id')]
    public string $investigationId;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonReviewRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\PersonReviewRequest $body;

    /**
     * @param  string  $investigationId
     * @param  \NoResponse\Models\Shared\PersonReviewRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $investigationId, Shared\PersonReviewRequest $body)
    {
        $this->investigationId = $investigationId;
        $this->body = $body;
    }
}