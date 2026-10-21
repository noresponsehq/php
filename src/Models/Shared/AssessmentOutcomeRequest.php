<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentOutcomeRequest - POST /v1/assessments/{assessment_id}/outcomes body: what the provider later learned about the account it assessed. The assessment is named by the path and the tenant by the API key, so neither is a body member. Idempotency-Key is required and binds the body as it does on POST /v1/assessments. */
class AssessmentOutcomeRequest
{
    /**
     * What the provider later learned about the assessed account. confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw an earlier abuse report of this tenant for the assessment; unknown is recorded only. Outcomes are append-only and the latest one recorded for an assessment wins.
     *
     * @var \NoResponse\Models\Shared\Outcome $outcome
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('outcome')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Outcome')]
    public Outcome $outcome;

    /**
     * When the provider observed the outcome. Defaults to when NoResponse received it.
     *
     * @var ?string $observedAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('observed_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $observedAt = null;

    /**
     * Your own opaque reference for the outcome, such as a case or ticket id. Stored as given and not interpreted; keep direct identifiers out of it.
     *
     * @var ?string $externalRef
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('external_ref')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $externalRef = null;

    /**
     * Free text for your own records, at most 500 characters. Stored only; it is left out of scoring and answers. Keep personal data out of it. Control characters other than tab and line breaks are refused.
     *
     * @var ?string $notes
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('notes')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $notes = null;

    /**
     * @param  \NoResponse\Models\Shared\Outcome  $outcome
     * @param  ?string  $observedAt
     * @param  ?string  $externalRef
     * @param  ?string  $notes
     * @phpstan-pure
     */
    public function __construct(Outcome $outcome, ?string $observedAt = null, ?string $externalRef = null, ?string $notes = null)
    {
        $this->outcome = $outcome;
        $this->observedAt = $observedAt;
        $this->externalRef = $externalRef;
        $this->notes = $notes;
    }
}