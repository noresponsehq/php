<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuditSettings - Read audit retention and available history. */
class AuditSettings
{
    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     *
     * @var int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    public int $retentionDays;

    /**
     *
     * @var ?string $oldestAvailableAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('oldest_available_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $oldestAvailableAt = null;

    /**
     *
     * @var string $capture
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('capture')]
    public string $capture;

    /**
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  int  $retentionDays
     * @param  string  $capture
     * @param  ?string  $oldestAvailableAt
     * @phpstan-pure
     */
    public function __construct(AuditSettingsEnvironment|string $environment, int $retentionDays, ?string $oldestAvailableAt = null, string $capture = 'available_events_only')
    {
        $this->environment = $environment;
        $this->retentionDays = $retentionDays;
        $this->oldestAvailableAt = $oldestAvailableAt;
        $this->capture = $capture;
    }
}