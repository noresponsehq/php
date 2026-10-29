<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListBulkRequest - At most 100 additions and removals combined. One transaction applies all changes or none. Idempotency-Key prevents duplicate changes for 24 hours; a different body under the same key returns 409. Matching reads see the new list immediately, while bounded durable jobs propagate account risk notifications. */
class ListBulkRequest
{
    /**
     * $add
     *
     * @var ?array<\NoResponse\Models\Shared\ListEntryRequest> $add
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('add')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ListEntryRequest>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $add = null;

    /**
     * $remove
     *
     * @var ?array<string> $remove
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('remove')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $remove = null;

    /**
     * @param  ?array<\NoResponse\Models\Shared\ListEntryRequest>  $add
     * @param  ?array<string>  $remove
     * @phpstan-pure
     */
    public function __construct(?array $add = null, ?array $remove = null)
    {
        $this->add = $add;
        $this->remove = $remove;
    }
}