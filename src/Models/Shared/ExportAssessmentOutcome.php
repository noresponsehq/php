<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ExportAssessmentOutcome - Structured fields of a retained per-assessment outcome. Legacy notes remain private as promised by the existing outcome contract. */
class ExportAssessmentOutcome
{
    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * What the provider later learned about the assessed account. confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw an earlier abuse report of this workspace for the assessment; unknown is recorded only. Outcomes are append-only and the latest one recorded for an assessment wins.
     *
     * @var \NoResponse\Models\Shared\Outcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcome|string')]
    public Outcome|string $outcome;

    /**
     *
     * @var string $observedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('observed_at')]
    public string $observedAt;

    /**
     *
     * @var string $receivedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('received_at')]
    public string $receivedAt;

    /**
     * Your own opaque reference for the outcome, such as a case or ticket id. Stored as given and not interpreted; keep direct identifiers out of it.
     *
     * @var ?string $externalRef
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_ref')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalRef = null;

    /**
     * @param  string  $id
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\Outcome|string  $outcome
     * @param  string  $observedAt
     * @param  string  $receivedAt
     * @param  ?string  $externalRef
     * @phpstan-pure
     */
    public function __construct(string $id, string $assessmentId, Outcome|string $outcome, string $observedAt, string $receivedAt, ?string $externalRef = null)
    {
        $this->id = $id;
        $this->assessmentId = $assessmentId;
        $this->outcome = $outcome;
        $this->observedAt = $observedAt;
        $this->receivedAt = $receivedAt;
        $this->externalRef = $externalRef;
    }
}