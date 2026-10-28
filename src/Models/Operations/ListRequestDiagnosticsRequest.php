<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListRequestDiagnosticsRequest
{
    /**
     * Inclusive start of a range of at most seven days.
     *
     * @var string $from
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=from')]
    public string $from;

    /**
     * Exclusive end of the range.
     *
     * @var string $to
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=to')]
    public string $to;

    /**
     * Optional filter or paging parameter.
     *
     * @var ?string $requestId
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=request_id')]
    public ?string $requestId = null;

    /**
     * Optional filter or paging parameter.
     *
     * @var ?string $route
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=route')]
    public ?string $route = null;

    /**
     * Optional filter or paging parameter.
     *
     * @var ?int $status
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=status')]
    public ?int $status = null;

    /**
     * Optional filter or paging parameter.
     *
     * @var ?string $cursor
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=cursor')]
    public ?string $cursor = null;

    /**
     * Optional filter or paging parameter.
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  ?string  $requestId
     * @param  ?string  $route
     * @param  ?int  $status
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, ?string $requestId = null, ?string $route = null, ?int $status = null, ?string $cursor = null, ?int $limit = 50)
    {
        $this->from = $from;
        $this->to = $to;
        $this->requestId = $requestId;
        $this->route = $route;
        $this->status = $status;
        $this->cursor = $cursor;
        $this->limit = $limit;
    }
}