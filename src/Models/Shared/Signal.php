<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Signal
{
    /**
     * Signal kind, for example account_presence or breach_exposure. New kinds may appear; ignore any you do not know.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * Which submitted identifier a signal concerns. ip is a selector of breach_exposure only.
     *
     * @var \NoResponse\Models\Shared\IdentifierKind $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierKind')]
    public IdentifierKind $identifier;

    /**
     * Per-signal outcome. A source that timed out, was blocked or errored reports blocked, unavailable or inconclusive with a reason and is listed in incomplete_sources; not_found is a definite absence.
     *
     * @var \NoResponse\Models\Shared\SignalOutcome $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SignalOutcome')]
    public SignalOutcome $outcome;

    /**
     * Opaque, workspace-scoped projection of the source that produced a signal. It stays stable for your workspace while the projection key is unchanged and reveals no upstream provider, feed, breach table or source record.
     *
     * @var string $sourceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('source_id')]
    public string $sourceId;

    /**
     * Freshness class of the evidence behind a signal. unknown whenever no evidence was obtained.
     *
     * @var \NoResponse\Models\Shared\Freshness $freshness
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('freshness')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Freshness')]
    public Freshness $freshness;

    /**
     * Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it.
     *
     * @var ?\NoResponse\Models\Shared\FailureReason $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FailureReason|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?FailureReason $reason = null;

    /**
     * Opaque pointer to evidence NoResponse holds for this signal. It carries no breach value, credential or page body.
     *
     * @var ?string $evidenceRef
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence_ref')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $evidenceRef = null;

    /**
     * When the evidence was first observed.
     *
     * @var ?string $observedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('observed_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $observedAt = null;

    /**
     * When the source was last queried for this identifier.
     *
     * @var ?string $lastCheckedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_checked_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastCheckedAt = null;

    /**
     * Facts about the number only: line type, carrier and country. The upstream provider, its scores and its verdicts stay internal.
     *
     * @var ?\NoResponse\Models\Shared\PhoneEnrichment $enrichment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('enrichment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PhoneEnrichment|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?PhoneEnrichment $enrichment = null;

    /**
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\IdentifierKind  $identifier
     * @param  \NoResponse\Models\Shared\SignalOutcome  $outcome
     * @param  string  $sourceId
     * @param  \NoResponse\Models\Shared\Freshness  $freshness
     * @param  ?\NoResponse\Models\Shared\FailureReason  $reason
     * @param  ?string  $evidenceRef
     * @param  ?string  $observedAt
     * @param  ?string  $lastCheckedAt
     * @param  ?\NoResponse\Models\Shared\PhoneEnrichment  $enrichment
     * @phpstan-pure
     */
    public function __construct(string $type, IdentifierKind $identifier, SignalOutcome $outcome, string $sourceId, Freshness $freshness, ?FailureReason $reason = null, ?string $evidenceRef = null, ?string $observedAt = null, ?string $lastCheckedAt = null, ?PhoneEnrichment $enrichment = null)
    {
        $this->type = $type;
        $this->identifier = $identifier;
        $this->outcome = $outcome;
        $this->sourceId = $sourceId;
        $this->freshness = $freshness;
        $this->reason = $reason;
        $this->evidenceRef = $evidenceRef;
        $this->observedAt = $observedAt;
        $this->lastCheckedAt = $lastCheckedAt;
        $this->enrichment = $enrichment;
    }
}