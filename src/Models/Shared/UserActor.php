<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class UserActor
{
    /**
     * The user's id at the identity provider the console signs people in with: 1 to 256 printable ASCII characters with no space, compared exactly.
     *
     * @var string $externalUserId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_user_id')]
    public string $externalUserId;

    /**
     * The public id of the console credential the user acted through.
     *
     * @var string $consoleCredentialId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('console_credential_id')]
    public string $consoleCredentialId;

    /**
     * Stable workspace principal id, retained across identity-provider subject migration. Absent for older events.
     *
     * @var ?string $principalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('principal_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $principalId = null;

    /**
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $type
     * @param  string  $externalUserId
     * @param  string  $consoleCredentialId
     * @param  ?string  $principalId
     * @phpstan-pure
     */
    public function __construct(string $externalUserId, string $consoleCredentialId, ?string $principalId = null, string $type = 'user')
    {
        $this->externalUserId = $externalUserId;
        $this->consoleCredentialId = $consoleCredentialId;
        $this->principalId = $principalId;
        $this->type = $type;
    }
}