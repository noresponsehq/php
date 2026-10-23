<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentOutcome - The 202 answer of POST /v1/assessments/{assessment_id}/outcomes. A replay with the same Idempotency-Key and body answers the same record. */
class AssessmentOutcome
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
     * @var \NoResponse\Models\Shared\Outcome $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcome')]
    public Outcome $outcome;

    /**
     * When NoResponse first recorded the outcome.
     *
     * @var string $receivedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('received_at')]
    public string $receivedAt;

    /**
     * @param  string  $id
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\Outcome  $outcome
     * @param  string  $receivedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $assessmentId, Outcome $outcome, string $receivedAt)
    {
        $this->id = $id;
        $this->assessmentId = $assessmentId;
        $this->outcome = $outcome;
        $this->receivedAt = $receivedAt;
    }
}