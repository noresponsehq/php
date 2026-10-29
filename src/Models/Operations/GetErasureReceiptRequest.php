<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetErasureReceiptRequest
{
    /**
     *
     * @var string $erasureId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=erasure_id')]
    public string $erasureId;

    /**
     * @param  string  $erasureId
     * @phpstan-pure
     */
    public function __construct(string $erasureId)
    {
        $this->erasureId = $erasureId;
    }
}