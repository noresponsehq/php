<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AuditEventTarget
{
    /**
     * The kind of resource the change acted on.
     *
     * @var \NoResponse\Models\Shared\AuditEventTargetType|string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditEventTargetType|string')]
    public AuditEventTargetType|string $type;

    /**
     * The resource's id, when it has one.
     *
     * @var ?string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $id = null;

    /**
     * @param  \NoResponse\Models\Shared\AuditEventTargetType|string  $type
     * @param  ?string  $id
     * @phpstan-pure
     */
    public function __construct(AuditEventTargetType|string $type, ?string $id = null)
    {
        $this->type = $type;
        $this->id = $id;
    }
}