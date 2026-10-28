<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountOutcomeRequest - Record a factual report, not an enforcement action. A known outcome replaces the effective report. unknown alone records uncertainty without changing it; unknown with supersedes explicitly retracts it. supersedes must name the current effective report or the request answers 409 outcome_conflict. Reports remain append-only. Idempotency-Key is required. observed_at defaults to receipt time and cannot be over five minutes ahead. */
class AccountOutcomeRequest
{
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
     * @var ?string $observedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('observed_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $observedAt = null;

    /**
     * Your own opaque reference for the outcome, such as a case or ticket id. Stored as given and not interpreted; keep direct identifiers out of it.
     *
     * @var ?string $externalRef
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('external_ref')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $externalRef = null;

    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var ?string $supersedes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('supersedes')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $supersedes = null;

    /**
     * @param  \NoResponse\Models\Shared\Outcome|string  $outcome
     * @param  ?string  $observedAt
     * @param  ?string  $externalRef
     * @param  ?string  $supersedes
     * @phpstan-pure
     */
    public function __construct(Outcome|string $outcome, ?string $observedAt = null, ?string $externalRef = null, ?string $supersedes = null)
    {
        $this->outcome = $outcome;
        $this->observedAt = $observedAt;
        $this->externalRef = $externalRef;
        $this->supersedes = $supersedes;
    }
}