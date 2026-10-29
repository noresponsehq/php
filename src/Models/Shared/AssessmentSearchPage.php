<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentSearchPage - A bounded page of latest assessment revisions, newest creation first, with how many assessments match the filters. Each item is the revision found and its first answer's decision; no current account risk is attached. */
class AssessmentSearchPage
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AssessmentSearchItem> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AssessmentSearchItem>')]
    public array $items;

    /**
     * How many assessments match the filters over every page, counted when this page was read: exact up to 10000. At 10000 or more it is 10000 and total_capped is true. The cursor does not change it; a later page can count differently, as results are live.
     *
     * @var int $total
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total')]
    public int $total;

    /**
     * True when at least 10000 assessments match, so total is 10000 and not the exact count.
     *
     * @var bool $totalCapped
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total_capped')]
    public bool $totalCapped;

    /**
     * Opaque, expiring cursor bound to this environment, operation and every filter. Keep the filters unchanged.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * The calling workspace's configured retention period in days. Default 365 (12 months), which is also the maximum: a workspace may only shorten it, to at least 1 day. Each record expires from its own created_at; see assessment expires_at.
     *
     * @var ?int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $retentionDays = null;

    /**
     * @param  string  $schemaVersion
     * @param  array<\NoResponse\Models\Shared\AssessmentSearchItem>  $items
     * @param  int  $total
     * @param  bool  $totalCapped
     * @param  ?string  $nextCursor
     * @param  ?int  $retentionDays
     * @phpstan-pure
     */
    public function __construct(array $items, int $total, bool $totalCapped, ?string $nextCursor = null, string $schemaVersion = '1', ?int $retentionDays = 365)
    {
        $this->items = $items;
        $this->total = $total;
        $this->totalCapped = $totalCapped;
        $this->nextCursor = $nextCursor;
        $this->schemaVersion = $schemaVersion;
        $this->retentionDays = $retentionDays;
    }
}