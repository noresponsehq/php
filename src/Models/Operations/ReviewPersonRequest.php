<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReviewPersonRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\PersonReviewRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\PersonReviewRequest $body;

    /**
     * @param  string  $groupId
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\PersonReviewRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $personId, Shared\PersonReviewRequest $body)
    {
        $this->groupId = $groupId;
        $this->personId = $personId;
        $this->body = $body;
    }
}