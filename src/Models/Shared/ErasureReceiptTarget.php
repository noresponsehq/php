<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ErasureReceiptTarget
{
    /**
     *
     * @var \NoResponse\Models\Shared\ErasureReceiptTargetName|string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ErasureReceiptTargetName|string')]
    public ErasureReceiptTargetName|string $name;

    /**
     *
     * @var \NoResponse\Models\Shared\ErasureReceiptTargetStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ErasureReceiptTargetStatus|string')]
    public ErasureReceiptTargetStatus|string $status;

    /**
     *
     * @var ?string $completedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('completed_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $completedAt = null;

    /**
     * @param  \NoResponse\Models\Shared\ErasureReceiptTargetName|string  $name
     * @param  \NoResponse\Models\Shared\ErasureReceiptTargetStatus|string  $status
     * @param  ?string  $completedAt
     * @phpstan-pure
     */
    public function __construct(ErasureReceiptTargetName|string $name, ErasureReceiptTargetStatus|string $status, ?string $completedAt = null)
    {
        $this->name = $name;
        $this->status = $status;
        $this->completedAt = $completedAt;
    }
}