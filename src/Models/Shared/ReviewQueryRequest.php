<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewQueryRequest
{
    /**
     * Only reviews of this exact account in the authenticated workspace and environment. Applied before pagination.
     *
     * @var ?string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountId = null;

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
     *
     * @var ?string $cursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

    /**
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  ?string  $accountId
     * @param  \NoResponse\Models\Shared\ReviewStatus|string|null  $status
     * @param  \NoResponse\Models\Shared\Priority|string|null  $priority
     * @param  ?string  $assignee
     * @param  ?bool  $unassigned
     * @param  ?string  $assigneePrincipalId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @phpstan-pure
     */
    public function __construct(?string $accountId = null, ReviewStatus|string|null $status = null, Priority|string|null $priority = null, ?string $assignee = null, ?bool $unassigned = null, ?string $assigneePrincipalId = null, ?string $cursor = null, ?int $limit = 50)
    {
        $this->accountId = $accountId;
        $this->status = $status;
        $this->priority = $priority;
        $this->assignee = $assignee;
        $this->unassigned = $unassigned;
        $this->assigneePrincipalId = $assigneePrincipalId;
        $this->cursor = $cursor;
        $this->limit = $limit;
    }
}