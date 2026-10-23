<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListWebhookDeliveriesRequest
{
    /**
     * The endpoint's whe_ id. An id that is unknown, malformed or another workspace's answers 404.
     *
     * @var string $endpointId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=endpoint_id')]
    public string $endpointId;

    /**
     * next_cursor from the previous page, unchanged.
     *
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     * Attempts per page.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $endpointId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @phpstan-pure
     */
    public function __construct(string $endpointId, ?string $cursor = null, ?int $limit = 20)
    {
        $this->endpointId = $endpointId;
        $this->cursor = $cursor;
        $this->limit = $limit;
    }
}