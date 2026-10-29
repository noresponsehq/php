<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SettingsRequest - Changes only named settings, atomically. Every successful write advances policy_version and retains an immutable settings snapshot. expected_policy_version optionally guards against stale edits; restore always requires it. */
class SettingsRequest
{
    /**
     *
     * @var ?int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $retentionDays = null;

    /**
     * Replaces the refused sources; [] refuses none. A change applies to new assessments within a minute.
     *
     * @var array<\NoResponse\Models\Shared\SourceId|string>|null $refusedSources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('refused_sources')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SourceId|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $refusedSources = null;

    /**
     * Use account_creation or its deprecated alias signup, not both.
     *
     * @var ?\NoResponse\Models\Shared\SettingsRequestFlows $flows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flows')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SettingsRequestFlows|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?SettingsRequestFlows $flows = null;

    /**
     * Compare-and-set guard. A stale version returns 409 policy_version_conflict before any change; every settings write including retention advances the version.
     *
     * @var ?int $expectedPolicyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_policy_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $expectedPolicyVersion = null;

    /**
     *
     * @var ?string $changeReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('change_reason')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $changeReason = null;

    /**
     * @param  ?int  $retentionDays
     * @param  array<\NoResponse\Models\Shared\SourceId|string>|null  $refusedSources
     * @param  ?\NoResponse\Models\Shared\SettingsRequestFlows  $flows
     * @param  ?int  $expectedPolicyVersion
     * @param  ?string  $changeReason
     * @phpstan-pure
     */
    public function __construct(?int $retentionDays = null, ?array $refusedSources = null, ?SettingsRequestFlows $flows = null, ?int $expectedPolicyVersion = null, ?string $changeReason = null)
    {
        $this->retentionDays = $retentionDays;
        $this->refusedSources = $refusedSources;
        $this->flows = $flows;
        $this->expectedPolicyVersion = $expectedPolicyVersion;
        $this->changeReason = $changeReason;
    }
}