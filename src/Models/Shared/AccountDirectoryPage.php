<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDirectoryPage - Distinct observed accounts with retained assessments. Typed identifier searches use stable opaque account order, independent of newly submitted assessments; ordinary and legacy email searches use newest-seen order. One repeatable-read database snapshot supplies each page's rows and totals. Pages do not share a snapshot: new matching accounts may appear on a later page or before the cursor and be missed until a fresh search; retention, erasure and changed membership can remove results. Current account decisions are read separately and may advance during a page. Cursors bind the workspace/environment, operation and filters, expire, and cannot cross scopes. Erasure and retention always take precedence over pagination. */
class AccountDirectoryPage
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AccountDirectoryPageItem> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AccountDirectoryPageItem>')]
    public array $items;

    /**
     * Distinct accounts matching the filters, exact below 10000 and capped at 10000.
     *
     * @var int $total
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total')]
    public int $total;

    /**
     * True when at least 10000 accounts match.
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
     * @param  string  $schemaVersion
     * @param  array<\NoResponse\Models\Shared\AccountDirectoryPageItem>  $items
     * @param  int  $total
     * @param  bool  $totalCapped
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(array $items, int $total, bool $totalCapped, ?string $nextCursor = null, string $schemaVersion = '1')
    {
        $this->items = $items;
        $this->total = $total;
        $this->totalCapped = $totalCapped;
        $this->nextCursor = $nextCursor;
        $this->schemaVersion = $schemaVersion;
    }
}