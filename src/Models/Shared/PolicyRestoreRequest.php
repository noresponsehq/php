<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PolicyRestoreRequest - Publish a captured configuration as a new version. Version checks and publication are atomic. Longer retention does not revive expired records, and restored policy does not undo customer enforcement. */
class PolicyRestoreRequest
{
    /**
     *
     * @var int $version
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('version')]
    public int $version;

    /**
     *
     * @var int $expectedPolicyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_policy_version')]
    public int $expectedPolicyVersion;

    /**
     *
     * @var string $changeReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('change_reason')]
    public string $changeReason;

    /**
     * @param  int  $version
     * @param  int  $expectedPolicyVersion
     * @param  string  $changeReason
     * @phpstan-pure
     */
    public function __construct(int $version, int $expectedPolicyVersion, string $changeReason)
    {
        $this->version = $version;
        $this->expectedPolicyVersion = $expectedPolicyVersion;
        $this->changeReason = $changeReason;
    }
}