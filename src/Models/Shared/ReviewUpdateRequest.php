<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewUpdateRequest
{
    /**
     *
     * @var int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    public int $expectedVersion;

    /**
     *
     * @var ?\NoResponse\Models\Shared\ReviewUpdateRequestStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewUpdateRequestStatus|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ReviewUpdateRequestStatus $status = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Priority|string|null $priority
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('priority')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Priority|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Priority|string|null $priority = null;

    /**
     *
     * @var ?string $assignee
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assignee')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assignee = null;

    /**
     * @param  int  $expectedVersion
     * @param  ?\NoResponse\Models\Shared\ReviewUpdateRequestStatus  $status
     * @param  \NoResponse\Models\Shared\Priority|string|null  $priority
     * @param  ?string  $assignee
     * @phpstan-pure
     */
    public function __construct(int $expectedVersion, ?ReviewUpdateRequestStatus $status = null, Priority|string|null $priority = null, ?string $assignee = null)
    {
        $this->expectedVersion = $expectedVersion;
        $this->status = $status;
        $this->priority = $priority;
        $this->assignee = $assignee;
    }
}