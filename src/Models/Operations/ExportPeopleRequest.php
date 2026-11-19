<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ExportPeopleRequest
{
    /**
     *
     * @var string $groupId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=group_id')]
    public string $groupId;

    /**
     * Read people after this one.
     *
     * @var ?string $after
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=after')]
    public ?string $after = null;

    /**
     * Only people with this decision; undecided for none yet.
     *
     * @var ?\NoResponse\Models\Shared\ListPeopleDecision $decision
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=decision')]
    public ?Shared\ListPeopleDecision $decision = null;

    /**
     * Only people with this role; unstated for people whose role was not given.
     *
     * @var ?\NoResponse\Models\Shared\ListPeopleRole $role
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=role')]
    public ?Shared\ListPeopleRole $role = null;

    /**
     * At most this many people.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $groupId
     * @param  ?int  $limit
     * @param  ?string  $after
     * @param  ?\NoResponse\Models\Shared\ListPeopleDecision  $decision
     * @param  ?\NoResponse\Models\Shared\ListPeopleRole  $role
     * @phpstan-pure
     */
    public function __construct(string $groupId, ?string $after = null, ?Shared\ListPeopleDecision $decision = null, ?Shared\ListPeopleRole $role = null, ?int $limit = 100)
    {
        $this->groupId = $groupId;
        $this->after = $after;
        $this->decision = $decision;
        $this->role = $role;
        $this->limit = $limit;
    }
}