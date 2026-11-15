<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListInvestigationsRequest
{
    /**
     *
     * @var ?string $personId
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=person_id')]
    public ?string $personId = null;

    /**
     *
     * @var ?string $before
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=before')]
    public ?string $before = null;

    /**
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  ?string  $personId
     * @param  ?string  $before
     * @param  ?int  $limit
     * @phpstan-pure
     */
    public function __construct(?string $personId = null, ?string $before = null, ?int $limit = 100)
    {
        $this->personId = $personId;
        $this->before = $before;
        $this->limit = $limit;
    }
}