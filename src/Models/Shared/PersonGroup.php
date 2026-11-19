<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonGroup - One group the person belongs to and their role in it. */
class PersonGroup
{
    /**
     *
     * @var string $groupId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_id')]
    public string $groupId;

    /**
     *
     * @var string $groupName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_name')]
    public string $groupName;

    /**
     * When the person was added to the group.
     *
     * @var string $addedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('added_at')]
    public string $addedAt;

    /**
     * The group's optional event start; null for an ongoing group.
     *
     * @var ?string $groupStartsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('group_starts_at')]
    public ?string $groupStartsAt;

    /**
     * The person's role in the group: guest, crew, vendor or press, or null when it was not given.
     *
     * @var \NoResponse\Models\Shared\PersonRole|string|null $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonRole|string|null')]
    public PersonRole|string|null $role;

    /**
     * @param  string  $groupId
     * @param  string  $groupName
     * @param  string  $addedAt
     * @param  ?string  $groupStartsAt
     * @param  \NoResponse\Models\Shared\PersonRole|string|null  $role
     * @phpstan-pure
     */
    public function __construct(string $groupId, string $groupName, string $addedAt, ?string $groupStartsAt = null, PersonRole|string|null $role = null)
    {
        $this->groupId = $groupId;
        $this->groupName = $groupName;
        $this->addedAt = $addedAt;
        $this->groupStartsAt = $groupStartsAt;
        $this->role = $role;
    }
}