<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PersonChange
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * account_added and account_removed: an account or profile appeared or disappeared. breach_added and breach_removed: a breach record appeared or disappeared. identifier_added and identifier_removed: an email, phone, username, name or account id on an account the person already held. field_changed: another field on such an account. finding_added: a new finding. posts_added: new posts, counted in count.
     *
     * @var \NoResponse\Models\Shared\PersonChangeKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonChangeKind|string')]
    public PersonChangeKind|string $kind;

    /**
     * One rule ranks every change: identity changes (accounts, breaches, identifiers) are high, profile fields and findings are medium, new posts are low.
     *
     * @var \NoResponse\Models\Shared\Significance|string $significance
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('significance')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Significance|string')]
    public Significance|string $significance;

    /**
     * The connector, site or platform the change came from.
     *
     * @var string $source
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('source')]
    public string $source;

    /**
     * The investigation that found the change.
     *
     * @var string $investigationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('investigation_id')]
    public string $investigationId;

    /**
     * The earlier investigation it was compared with.
     *
     * @var string $previousInvestigationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('previous_investigation_id')]
    public string $previousInvestigationId;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var ?string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $field = null;

    /**
     *
     * @var ?string $before
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('before')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $before = null;

    /**
     *
     * @var ?string $after
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('after')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $after = null;

    /**
     *
     * @var ?int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $count = null;

    /**
     *
     * @var ?string $reviewedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviewed_at')]
    public ?string $reviewedAt;

    /**
     *
     * @var ?string $reviewedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reviewed_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $reviewedBy = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\PersonChangeKind|string  $kind
     * @param  \NoResponse\Models\Shared\Significance|string  $significance
     * @param  string  $source
     * @param  string  $investigationId
     * @param  string  $previousInvestigationId
     * @param  string  $createdAt
     * @param  ?string  $field
     * @param  ?string  $before
     * @param  ?string  $after
     * @param  ?int  $count
     * @param  ?string  $reviewedAt
     * @param  ?string  $reviewedBy
     * @phpstan-pure
     */
    public function __construct(string $id, PersonChangeKind|string $kind, Significance|string $significance, string $source, string $investigationId, string $previousInvestigationId, string $createdAt, ?string $field = null, ?string $before = null, ?string $after = null, ?int $count = null, ?string $reviewedAt = null, ?string $reviewedBy = null)
    {
        $this->id = $id;
        $this->kind = $kind;
        $this->significance = $significance;
        $this->source = $source;
        $this->investigationId = $investigationId;
        $this->previousInvestigationId = $previousInvestigationId;
        $this->createdAt = $createdAt;
        $this->field = $field;
        $this->before = $before;
        $this->after = $after;
        $this->count = $count;
        $this->reviewedAt = $reviewedAt;
        $this->reviewedBy = $reviewedBy;
    }
}