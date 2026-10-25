<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SettingsRequest - PATCH /v1/workspaces/{workspace_id}/settings/{environment} body. Changes only what it names, in one transaction; a policy change is one new policy_version. Needs the admin or owner role, or an API key with the management scope for its own environment. */
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
     * @param  ?int  $retentionDays
     * @param  array<\NoResponse\Models\Shared\SourceId|string>|null  $refusedSources
     * @param  ?\NoResponse\Models\Shared\SettingsRequestFlows  $flows
     * @phpstan-pure
     */
    public function __construct(?int $retentionDays = null, ?array $refusedSources = null, ?SettingsRequestFlows $flows = null)
    {
        $this->retentionDays = $retentionDays;
        $this->refusedSources = $refusedSources;
        $this->flows = $flows;
    }
}