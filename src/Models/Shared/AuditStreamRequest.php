<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AuditStreamRequest
{
    /**
     *
     * @var string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    public string $endpointId;

    /**
     * $actions
     *
     * @var ?array<string> $actions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actions')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $actions = null;

    /**
     * @param  string  $endpointId
     * @param  ?array<string>  $actions
     * @phpstan-pure
     */
    public function __construct(string $endpointId, ?array $actions = null)
    {
        $this->endpointId = $endpointId;
        $this->actions = $actions;
    }
}