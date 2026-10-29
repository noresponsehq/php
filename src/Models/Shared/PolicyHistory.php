<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyHistory - Immutable settings snapshots, newest first. history_complete is false when earlier versions predate capture. A restored version is published with a fresh version number. History is removed with the tenant. */
class PolicyHistory
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\PolicyHistoryItem> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PolicyHistoryItem>')]
    public array $items;

    /**
     *
     * @var bool $hasMore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('has_more')]
    public bool $hasMore;

    /**
     *
     * @var bool $historyComplete
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('history_complete')]
    public bool $historyComplete;

    /**
     *
     * @var ?int $nextBeforeVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_before_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $nextBeforeVersion = null;

    /**
     * @param  array<\NoResponse\Models\Shared\PolicyHistoryItem>  $items
     * @param  bool  $hasMore
     * @param  bool  $historyComplete
     * @param  ?int  $nextBeforeVersion
     * @phpstan-pure
     */
    public function __construct(array $items, bool $hasMore, bool $historyComplete, ?int $nextBeforeVersion = null)
    {
        $this->items = $items;
        $this->hasMore = $hasMore;
        $this->historyComplete = $historyComplete;
        $this->nextBeforeVersion = $nextBeforeVersion;
    }
}