<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Settings - One environment's settings: how long its assessments are kept, and for each flow the risk thresholds that decide it and the depth a request that names none is served at, and the sources it refuses. Live and test each have their own. A flow without thresholds of its own uses account_creation's (inherits_account_creation). Every change is recorded in the audit log as settings.updated, with who made it. */
class Settings
{
    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     * The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyEnvironment|string')]
    public KeyEnvironment|string $environment;

    /**
     * Days an assessment is kept after it is created, 1 to 365 (default 365). Shortening hides older assessments at once.
     *
     * @var int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    public int $retentionDays;

    /**
     * The monotonic settings configuration epoch, including retention changes. Zero while defaults apply. Historical assessments keep their frozen policy version; the active version reaches new assessments within a minute.
     *
     * @var int $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public int $policyVersion;

    /**
     *
     * @var \NoResponse\Models\Shared\SettingsFlows $flows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flows')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SettingsFlows')]
    public SettingsFlows $flows;

    /**
     * The sources this environment refuses, sorted; empty, the default, refuses none. An assessment leaves a refused source out: its coverage is missing (an identifier with no other source lists coverage-unavailable as unavailable) rather than not_found, and a stored result of a refused source is not reused.
     *
     * @var array<\NoResponse\Models\Shared\SourceId|string> $refusedSources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('refused_sources')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SourceId|string>')]
    public array $refusedSources;

    /**
     * Who last changed the policy: the member's external user id for a change made through the console, the prefix (nrk_<environment>_<key id>) of the management key that made it, or NoResponse. Absent while the defaults apply.
     *
     * @var ?string $updatedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_by')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $updatedBy = null;

    /**
     * When the policy last changed. Absent while the defaults apply.
     *
     * @var ?string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $updatedAt = null;

    /**
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  int  $retentionDays
     * @param  int  $policyVersion
     * @param  \NoResponse\Models\Shared\SettingsFlows  $flows
     * @param  array<\NoResponse\Models\Shared\SourceId|string>  $refusedSources
     * @param  ?string  $updatedBy
     * @param  ?string  $updatedAt
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, KeyEnvironment|string $environment, int $retentionDays, int $policyVersion, SettingsFlows $flows, array $refusedSources, ?string $updatedBy = null, ?string $updatedAt = null)
    {
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->retentionDays = $retentionDays;
        $this->policyVersion = $policyVersion;
        $this->flows = $flows;
        $this->refusedSources = $refusedSources;
        $this->updatedBy = $updatedBy;
        $this->updatedAt = $updatedAt;
    }
}