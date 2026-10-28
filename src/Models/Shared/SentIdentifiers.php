<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SentIdentifiers - The identifiers an assessment was sent: each member of the request's identifiers object exactly as received, before the server normalised it (the email domain keeps its case, the name its Unicode form). A member the request did not send is absent. NoResponse keeps them encrypted under the workspace's own key, does not index or log them, and deletes them with the assessment: on DELETE of the assessment or its account, at its expires_at, and with the workspace. */
class SentIdentifiers
{
    /**
     * identifiers.email as the request sent it.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * identifiers.username as the request sent it.
     *
     * @var ?string $username
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('username')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $username = null;

    /**
     * identifiers.phone as the request sent it.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * identifiers.name as the request sent it, before NFC normalisation.
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     * identifiers.ip as the request sent it.
     *
     * @var ?string $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $ip = null;

    /**
     * @param  ?string  $email
     * @param  ?string  $username
     * @param  ?string  $phone
     * @param  ?string  $name
     * @param  ?string  $ip
     * @phpstan-pure
     */
    public function __construct(?string $email = null, ?string $username = null, ?string $phone = null, ?string $name = null, ?string $ip = null)
    {
        $this->email = $email;
        $this->username = $username;
        $this->phone = $phone;
        $this->name = $name;
        $this->ip = $ip;
    }
}