<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** GroupUpdate - Updates a group. Dates describe an optional event and do not control person retention. */
class GroupUpdate
{
    /**
     * The group's name.
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     * The attribute its people share. Omit to keep the current value.
     *
     * @var ?string $attribute
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attribute')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $attribute = null;

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
     * The people the group protects, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Principal> $principals
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('principals')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Principal>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $principals = null;

    /**
     * Sensitive topics the screening reads posts against, at most 50.
     *
     * @var ?array<string> $topics
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('topics')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $topics = null;

    /**
     * When present, the change applies only if the group is still at this version (409 group_conflict otherwise).
     *
     * @var ?int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $expectedVersion = null;

    /**
     * Optional event start; null for an ongoing group. Omit to keep the current value; send null to clear it.
     *
     * @var ?string $startsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('starts_at')]
    public ?string $startsAt;

    /**
     * Optional event end; requires starts_at and must be at or after it. Null when no end is set. Omit to keep the current value; send null to clear it.
     *
     * @var ?string $endsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ends_at')]
    public ?string $endsAt;

    /**
     * @param  ?string  $name
     * @param  ?string  $attribute
     * @param  ?string  $venue
     * @param  ?string  $host
     * @param  ?array<\NoResponse\Models\Shared\Principal>  $principals
     * @param  ?array<string>  $topics
     * @param  ?int  $expectedVersion
     * @param  string|null|\NoResponse\Utils\Absent  $startsAt
     * @param  string|null|\NoResponse\Utils\Absent  $endsAt
     * @phpstan-pure
     */
    public function __construct(?string $name = null, ?string $attribute = null, ?string $venue = null, ?string $host = null, ?array $principals = null, ?array $topics = null, ?int $expectedVersion = null, string|null|\NoResponse\Utils\Absent $startsAt = \NoResponse\Utils\Absent::Value, string|null|\NoResponse\Utils\Absent $endsAt = \NoResponse\Utils\Absent::Value)
    {
        $this->name = $name;
        $this->attribute = $attribute;
        $this->venue = $venue;
        $this->host = $host;
        $this->principals = $principals;
        $this->topics = $topics;
        $this->expectedVersion = $expectedVersion;
        if ($startsAt !== \NoResponse\Utils\Absent::Value) {
            $this->startsAt = $startsAt;
        }
        if ($endsAt !== \NoResponse\Utils\Absent::Value) {
            $this->endsAt = $endsAt;
        }
    }
}