<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListWorkspacePeopleRequest
{
    /**
     * Pass next_cursor from the prior page.
     *
     * @var ?string $after
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=after')]
    public ?string $after = null;

    /**
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  ?int  $limit
     * @param  ?string  $after
     * @phpstan-pure
     */
    public function __construct(?string $after = null, ?int $limit = 100)
    {
        $this->after = $after;
        $this->limit = $limit;
    }
}