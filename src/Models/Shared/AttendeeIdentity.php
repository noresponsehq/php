<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AttendeeIdentity - What you know about an attendee. Stored encrypted under the workspace's key. */
class AttendeeIdentity
{
    /**
     * The attendee's full name.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * Your own id for the attendee, unique within the event. A later row with the same external id updates this attendee.
     *
     * @var ?string $externalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalId = null;

    /**
     * The attendee's email.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The attendee's phone in E.164 form.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * Where the attendee works.
     *
     * @var ?string $company
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $company = null;

    /**
     * Where the attendee lives.
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     * Accounts the attendee is known to hold, at most 20.
     *
     * @var ?array<\NoResponse\Models\Shared\Handle> $handles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handles')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Handle>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $handles = null;

    /**
     * @param  string  $name
     * @param  ?string  $externalId
     * @param  ?string  $email
     * @param  ?string  $phone
     * @param  ?string  $company
     * @param  ?string  $city
     * @param  ?array<\NoResponse\Models\Shared\Handle>  $handles
     * @phpstan-pure
     */
    public function __construct(string $name, ?string $externalId = null, ?string $email = null, ?string $phone = null, ?string $company = null, ?string $city = null, ?array $handles = null)
    {
        $this->name = $name;
        $this->externalId = $externalId;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->city = $city;
        $this->handles = $handles;
    }
}