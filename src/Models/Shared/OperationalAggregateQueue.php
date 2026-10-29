<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OperationalAggregateQueue - Current retained delivery queue, independent of the requested attempt window and status filter. Endpoint filter applies. Does not prove customer enforcement execution. */
class OperationalAggregateQueue
{
    /**
     *
     * @var int $pending
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('pending')]
    public int $pending;

    /**
     *
     * @var int $leased
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('leased')]
    public int $leased;

    /**
     *
     * @var int $deadRetained
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('dead_retained')]
    public int $deadRetained;

    /**
     *
     * @var ?string $oldestPendingAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('oldest_pending_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $oldestPendingAt = null;

    /**
     * @param  int  $pending
     * @param  int  $leased
     * @param  int  $deadRetained
     * @param  ?string  $oldestPendingAt
     * @phpstan-pure
     */
    public function __construct(int $pending, int $leased, int $deadRetained, ?string $oldestPendingAt = null)
    {
        $this->pending = $pending;
        $this->leased = $leased;
        $this->deadRetained = $deadRetained;
        $this->oldestPendingAt = $oldestPendingAt;
    }
}