<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonIdentity - What you know about a person. Stored encrypted under the workspace's key. */
class PersonIdentity
{
    /**
     * The person's full name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * Your own id for the person, unique within the group. A later row with the same external id updates this person.
     *
     * @var ?string $externalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalId = null;

    /**
     * The person's email.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The person's phone in E.164 form.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * Where the person works.
     *
     * @var ?string $company
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $company = null;

    /**
     * Where the person lives.
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     * Accounts the person is known to hold, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Handle> $handles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Handle>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $handles = null;

    /**
     * The person's role in the group: guest (a ticket holder), crew, vendor or press. Leave it out when you do not know it: a person without one has no role, not guest. A later row naming the same person replaces it, and a change of role alone keeps the person's screening results.
     *
     * @var \NoResponse\Models\Shared\PersonRole|string|null $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PersonRole|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public PersonRole|string|null $role = null;

    /**
     * @param  string  $name
     * @param  ?string  $externalId
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @param  \NoResponse\Models\Shared\PersonRole|string|null  $role
     * @phpstan-pure
     */
    public function __construct(string $name, ?string $externalId = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?array $handles = null, PersonRole|string|null $role = null)
    {
        $this->name = $name;
        $this->externalId = $externalId;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->handles = $handles;
        $this->role = $role;
    }
}