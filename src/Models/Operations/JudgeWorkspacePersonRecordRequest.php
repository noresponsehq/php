<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class JudgeWorkspacePersonRecordRequest
{
    /**
     *
     * @var string $personId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\RecordVerdictRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\RecordVerdictRequest $body;

    /**
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\RecordVerdictRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $personId, Shared\RecordVerdictRequest $body)
    {
        $this->personId = $personId;
        $this->body = $body;
    }
}