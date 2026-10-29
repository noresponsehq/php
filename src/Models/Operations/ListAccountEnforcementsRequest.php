<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListAccountEnforcementsRequest
{
    /**
     * The account_id the workspace sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
     *
     * @var string $accountId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=account_id')]
    public string $accountId;

    /**
     * next_cursor from the previous page, unchanged.
     *
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     * Items per page.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @phpstan-pure
     */
    public function __construct(string $accountId, ?string $cursor = null, ?int $limit = 20)
    {
        $this->accountId = $accountId;
        $this->cursor = $cursor;
        $this->limit = $limit;
    }
}