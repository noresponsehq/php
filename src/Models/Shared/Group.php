<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Group - A workspace group for a building, organization or event. Dates are optional and do not control person retention. */
class Group
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     * The group's name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * What the group's people share: an event, an organisation, a place or another attribute.
     *
     * @var \NoResponse\Models\Shared\GroupType|string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\GroupType|string')]
    public GroupType|string $type;

    /**
     * The attribute its people share. Empty when none was given.
     *
     * @var string $attribute
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attribute')]
    public string $attribute;

    /**
     * The people the group protects.
     *
     * @var array<\NoResponse\Models\Shared\Principal> $principals
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('principals')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Principal>')]
    public array $principals;

    /**
     * Sensitive topics.
     *
     * @var array<string> $topics
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('topics')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $topics;

    /**
     * How many people the group holds.
     *
     * @var int $people
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people')]
    public int $people;

    /**
     * Goes up by one with every change.
     *
     * @var int $version
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('version')]
    public int $version;

    /**
     * The member or key label that created the group.
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     * Optional event start; null for an ongoing group.
     *
     * @var ?string $startsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('starts_at')]
    public ?string $startsAt;

    /**
     * Optional event end; requires starts_at and must be at or after it. Null when no end is set.
     *
     * @var ?string $endsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ends_at')]
    public ?string $endsAt;

    /**
     * Where the group is held.
     *
     * @var ?string $venue
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('venue')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $venue = null;

    /**
     * The organisation hosting the group.
     *
     * @var ?string $host
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('host')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $host = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $name
     * @param  \NoResponse\Models\Shared\GroupType|string  $type
     * @param  string  $attribute
     * @param  array<\NoResponse\Models\Shared\Principal>  $principals
     * @param  array<string>  $topics
     * @param  int  $people
     * @param  int  $version
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  ?string  $startsAt
     * @param  ?string  $endsAt
     * @param  ?string  $venue
     * @param  ?string  $host
     * @phpstan-pure
     */
    public function __construct(string $id, AuditSettingsEnvironment|string $environment, string $name, GroupType|string $type, string $attribute, array $principals, array $topics, int $people, int $version, string $createdBy, string $createdAt, string $updatedAt, ?string $startsAt = null, ?string $endsAt = null, ?string $venue = null, ?string $host = null)
    {
        $this->id = $id;
        $this->environment = $environment;
        $this->name = $name;
        $this->type = $type;
        $this->attribute = $attribute;
        $this->principals = $principals;
        $this->topics = $topics;
        $this->people = $people;
        $this->version = $version;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->venue = $venue;
        $this->host = $host;
    }
}