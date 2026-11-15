<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CancelInvestigationRequest
{
    /**
     *
     * @var string $investigationId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=investigation_id')]
    public string $investigationId;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningCancelRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\ScreeningCancelRequest $body;

    /**
     * @param  string  $investigationId
     * @param  \NoResponse\Models\Shared\ScreeningCancelRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $investigationId, Shared\ScreeningCancelRequest $body)
    {
        $this->investigationId = $investigationId;
        $this->body = $body;
    }
}