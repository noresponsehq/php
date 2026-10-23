<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountAssessmentsRequest
{
    /**
     * The account_id the tenant sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
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
     * Optional standard or separately authorised detailed customer view; raw is rejected.
     *
     * @var ?\NoResponse\Models\Shared\ResponseMode $responseMode
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=response_mode')]
    public ?Shared\ResponseMode $responseMode = null;

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
     * @param  ?\NoResponse\Models\Shared\ResponseMode  $responseMode
     * @phpstan-pure
     */
    public function __construct(string $accountId, ?string $cursor = null, ?Shared\ResponseMode $responseMode = null, ?int $limit = 20)
    {
        $this->accountId = $accountId;
        $this->cursor = $cursor;
        $this->responseMode = $responseMode;
        $this->limit = $limit;
    }
}