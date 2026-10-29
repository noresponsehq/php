<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyHistoryItem
{
    /**
     * One environment's settings: how long its assessments are kept, and for each flow the risk thresholds that decide it and the depth a request that names none is served at, and the sources it refuses. Live and test each have their own. A flow without thresholds of its own uses account_creation's (inherits_account_creation). Every change is recorded in the audit log as settings.updated, with who made it.
     *
     * @var \NoResponse\Models\Shared\Settings $settings
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('settings')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Settings')]
    public Settings $settings;

    /**
     * Capture time, not a backfilled activation time. Absent only for the current configuration before its first capture.
     *
     * @var ?string $recordedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('recorded_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $recordedAt = null;

    /**
     *
     * @var ?string $changeReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('change_reason')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $changeReason = null;

    /**
     *
     * @var ?int $restoredFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('restored_from')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $restoredFrom = null;

    /**
     * Immutable publication provenance remains in policy history after evaluation evidence expires. SHA-256 values identify the frozen manifest, evaluator semantic input, cohort, and canonical result separately.
     *
     * @var ?\NoResponse\Models\Shared\Publication $evaluation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Publication|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Publication $evaluation = null;

    /**
     * @param  \NoResponse\Models\Shared\Settings  $settings
     * @param  ?string  $recordedAt
     * @param  ?string  $changeReason
     * @param  ?int  $restoredFrom
     * @param  ?\NoResponse\Models\Shared\Publication  $evaluation
     * @phpstan-pure
     */
    public function __construct(Settings $settings, ?string $recordedAt = null, ?string $changeReason = null, ?int $restoredFrom = null, ?Publication $evaluation = null)
    {
        $this->settings = $settings;
        $this->recordedAt = $recordedAt;
        $this->changeReason = $changeReason;
        $this->restoredFrom = $restoredFrom;
        $this->evaluation = $evaluation;
    }
}