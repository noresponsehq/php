<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AccountOutcomeActor
{
    /**
     *
     * @var \NoResponse\Models\Shared\AccountOutcomeActorType|string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountOutcomeActorType|string')]
    public AccountOutcomeActorType|string $type;

    /**
     *
     * @var ?string $keyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $keyId = null;

    /**
     * The user's id at the identity provider the console signs people in with: 1 to 256 printable ASCII characters with no space, compared exactly.
     *
     * @var ?string $externalUserId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_user_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalUserId = null;

    /**
     *
     * @var ?string $consoleCredentialId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('console_credential_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $consoleCredentialId = null;

    /**
     * Opaque, server-assigned member id: mem_ and a 26-character ULID. It stays the same when a removed member is invited back.
     *
     * @var ?string $principalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('principal_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $principalId = null;

    /**
     * @param  \NoResponse\Models\Shared\AccountOutcomeActorType|string  $type
     * @param  ?string  $keyId
     * @param  ?string  $externalUserId
     * @param  ?string  $consoleCredentialId
     * @param  ?string  $principalId
     * @phpstan-pure
     */
    public function __construct(AccountOutcomeActorType|string $type, ?string $keyId = null, ?string $externalUserId = null, ?string $consoleCredentialId = null, ?string $principalId = null)
    {
        $this->type = $type;
        $this->keyId = $keyId;
        $this->externalUserId = $externalUserId;
        $this->consoleCredentialId = $consoleCredentialId;
        $this->principalId = $principalId;
    }
}