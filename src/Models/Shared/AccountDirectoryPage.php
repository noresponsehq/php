<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDirectoryPage - Accounts observed in retained assessments, newest seen first, with each account once per page and across pages. Counts and keyset pagination are computed over distinct accounts in one database snapshot per page. Live data can change between pages. */
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