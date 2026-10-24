<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListAccountsRequest
{
    /**
     * next_cursor from an earlier page, unchanged. Absent, the list starts from the oldest change.
     *
     * @var ?string $changedSince
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=changed_since')]
    public ?string $changedSince = null;

    /**
     * Most accounts per page.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * true lists only accounts with a decision other than allow for some flow and no applied enforcement at their current risk_version.
     *
     * @var ?bool $unenforced
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=unenforced')]
    public ?bool $unenforced = null;

    /**
     * @param  ?string  $changedSince
     * @param  ?int  $limit
     * @param  ?bool  $unenforced
     * @phpstan-pure
     */
    public function __construct(?string $changedSince = null, ?int $limit = 50, ?bool $unenforced = false)
    {
        $this->changedSince = $changedSince;
        $this->limit = $limit;
        $this->unenforced = $unenforced;
    }
}