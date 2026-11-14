<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** GroupRequest - Creates a group. */
class GroupRequest
{
    /**
     * The group's name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * When the group starts.
     *
     * @var string $startsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('starts_at')]
    public string $startsAt;

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
     * @param  string  $name
     * @param  string  $startsAt
     * @param  ?string  $endsAt
     * @param  ?string  $venue
     * @param  ?string  $host
     * @param  ?array<\NoResponse\Models\Shared\Principal>  $principals
     * @param  ?array<string>  $topics
     * @phpstan-pure
     */
    public function __construct(string $name, string $startsAt, ?string $endsAt = null, ?string $venue = null, ?string $host = null, ?array $principals = null, ?array $topics = null)
    {
        $this->name = $name;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->venue = $venue;
        $this->host = $host;
        $this->principals = $principals;
        $this->topics = $topics;
    }
}