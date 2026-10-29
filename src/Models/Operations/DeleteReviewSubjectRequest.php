<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class DeleteReviewSubjectRequest
{
    /**
     * Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.
     *
     * @var string $workspaceId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=workspace_id')]
    public string $workspaceId;

    /**
     * The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=environment')]
    public Shared\KeyEnvironment|string $environment;

    /**
     *
     * @var string $reviewId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=review_id')]
    public string $reviewId;

    /**
     *
     * @var string $subjectId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=subject_id')]
    public string $subjectId;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewViewDeleteRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\ReviewViewDeleteRequest $body;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  string  $reviewId
     * @param  string  $subjectId
     * @param  \NoResponse\Models\Shared\ReviewViewDeleteRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, Shared\KeyEnvironment|string $environment, string $reviewId, string $subjectId, Shared\ReviewViewDeleteRequest $body)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->reviewId = $reviewId;
        $this->subjectId = $subjectId;
        $this->body = $body;
    }
}