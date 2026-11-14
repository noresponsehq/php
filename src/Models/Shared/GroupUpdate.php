<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** GroupUpdate - Changes the fields it names; at least one besides expected_version. */
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
     * When the group starts.
     *
     * @var ?string $startsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('starts_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $startsAt = null;

    /**
     * When the group ends, at or after its start; the start when omitted.
     *
     * @var ?string $endsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ends_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $endsAt = null;

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
     * @param  ?string  $name
     * @param  ?string  $startsAt
     * @param  ?string  $endsAt
     * @param  ?string  $venue
     * @param  ?string  $host
     * @param  ?array<\NoResponse\Models\Shared\Principal>  $principals
     * @param  ?array<string>  $topics
     * @param  ?int  $expectedVersion
     * @phpstan-pure
     */
    public function __construct(?string $name = null, ?string $startsAt = null, ?string $endsAt = null, ?string $venue = null, ?string $host = null, ?array $principals = null, ?array $topics = null, ?int $expectedVersion = null)
    {
        $this->name = $name;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->venue = $venue;
        $this->host = $host;
        $this->principals = $principals;
        $this->topics = $topics;
        $this->expectedVersion = $expectedVersion;
    }
}