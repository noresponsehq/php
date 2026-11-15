<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListGroupsRequest
{
    /**
     * Read groups older than this one.
     *
     * @var ?string $before
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=before')]
    public ?string $before = null;

    /**
     * At most this many items.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  ?int  $limit
     * @param  ?string  $before
     * @phpstan-pure
     */
    public function __construct(?string $before = null, ?int $limit = 20)
    {
        $this->before = $before;
        $this->limit = $limit;
    }
}