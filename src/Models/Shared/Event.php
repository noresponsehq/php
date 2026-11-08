<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Event - An event and its screening context. */
class Event
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
     * The event's name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * When the event starts.
     *
     * @var string $startsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('starts_at')]
    public string $startsAt;

    /**
     * When the event ends, at or after its start; the start when omitted.
     *
     * @var string $endsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ends_at')]
    public string $endsAt;

    /**
     * The people the event protects.
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
     * How many attendees the event holds.
     *
     * @var int $attendees
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attendees')]
    public int $attendees;

    /**
     * Goes up by one with every change.
     *
     * @var int $version
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('version')]
    public int $version;

    /**
     * When raw collected items and unmatched candidate profiles are purged: 30 days after the event ends.
     *
     * @var string $purgeAfter
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('purge_after')]
    public string $purgeAfter;

    /**
     * The member or key label that created the event.
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
     * Where the event is held.
     *
     * @var ?string $venue
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('venue')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $venue = null;

    /**
     * The organisation hosting the event.
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
     * @param  string  $startsAt
     * @param  string  $endsAt
     * @param  array<\NoResponse\Models\Shared\Principal>  $principals
     * @param  array<string>  $topics
     * @param  int  $attendees
     * @param  int  $version
     * @param  string  $purgeAfter
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  ?string  $venue
     * @param  ?string  $host
     * @phpstan-pure
     */
    public function __construct(string $id, AuditSettingsEnvironment|string $environment, string $name, string $startsAt, string $endsAt, array $principals, array $topics, int $attendees, int $version, string $purgeAfter, string $createdBy, string $createdAt, string $updatedAt, ?string $venue = null, ?string $host = null)
    {
        $this->id = $id;
        $this->environment = $environment;
        $this->name = $name;
        $this->startsAt = $startsAt;
        $this->endsAt = $endsAt;
        $this->principals = $principals;
        $this->topics = $topics;
        $this->attendees = $attendees;
        $this->version = $version;
        $this->purgeAfter = $purgeAfter;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->venue = $venue;
        $this->host = $host;
    }
}