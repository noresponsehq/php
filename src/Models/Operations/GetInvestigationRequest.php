<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetInvestigationRequest
{
    /**
     *
     * @var string $investigationId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=investigation_id')]
    public string $investigationId;

    /**
     * @param  string  $investigationId
     * @phpstan-pure
     */
    public function __construct(string $investigationId)
    {
        $this->investigationId = $investigationId;
    }
}