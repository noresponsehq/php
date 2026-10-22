<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IntegrationList - GET /v1/integrations: every integration of the tenant, oldest first, at most 10. No secret is ever listed. */
class IntegrationList
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Integration> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Integration>')]
    public array $items;

    /**
     * @param  array<\NoResponse\Models\Shared\Integration>  $items
     * @phpstan-pure
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }
}