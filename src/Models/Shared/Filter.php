<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Filter
{
    /**
     *
     * @var \NoResponse\Models\Shared\ReviewStatus|string|null $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewStatus|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ReviewStatus|string|null $status = null;

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
     *
     * @var ?bool $unassigned
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unassigned')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $unassigned = null;

    /**
     *
     * @var ?string $assigneePrincipalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assignee_principal_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assigneePrincipalId = null;

    /**
     * @param  \NoResponse\Models\Shared\ReviewStatus|string|null  $status
     * @param  \NoResponse\Models\Shared\Priority|string|null  $priority
     * @param  ?string  $assignee
     * @param  ?bool  $unassigned
     * @param  ?string  $assigneePrincipalId
     * @phpstan-pure
     */
    public function __construct(ReviewStatus|string|null $status = null, Priority|string|null $priority = null, ?string $assignee = null, ?bool $unassigned = null, ?string $assigneePrincipalId = null)
    {
        $this->status = $status;
        $this->priority = $priority;
        $this->assignee = $assignee;
        $this->unassigned = $unassigned;
        $this->assigneePrincipalId = $assigneePrincipalId;
    }
}