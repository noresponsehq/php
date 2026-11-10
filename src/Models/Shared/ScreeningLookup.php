<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningLookup - What the signup check's lookups found for an attendee: account presence for the email, phone and usernames (the attendee's handles), the phone lookup, the email domain's registration and the breach search. Context and coverage for the reviewer, not a finding: nothing here sets a band or a match state. */
class ScreeningLookup
{
    /**
     * Each lane each identifier was looked up in, identifiers in the order email, phone, username and lanes in the order accounts, phone, breach, domain. Every lane the attendee's identifiers are looked up in is listed: one that no source answered, or that no source could be asked in, is not_covered. Empty when the attendee has no email, phone or handle to look up.
     *
     * @var array<\NoResponse\Models\Shared\ScreeningLookupCheck> $checks
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('checks')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningLookupCheck>')]
    public array $checks;

    /**
     * When the lookups ran.
     *
     * @var string $lookedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('looked_at')]
    public string $lookedAt;

    /**
     * A few typed facts per identifier: an assessment's risk.summary, and an event screening attendee's lookup summary. Every fact is optional: absent means the evidence did not answer and makes no claim, while false or 0 is a definite answer.
     *
     * @var ?\NoResponse\Models\Shared\RiskSummary $summary
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('summary')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskSummary|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskSummary $summary = null;

    /**
     * Merged observations behind the summary, served only to a caller who may read evidence: no provider, source, origin, raw breach record or score.
     *
     * @var ?\NoResponse\Models\Shared\RiskDetails $details
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('details')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskDetails|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskDetails $details = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ScreeningLookupCheck>  $checks
     * @param  string  $lookedAt
     * @param  ?\NoResponse\Models\Shared\RiskSummary  $summary
     * @param  ?\NoResponse\Models\Shared\RiskDetails  $details
     * @phpstan-pure
     */
    public function __construct(array $checks, string $lookedAt, ?RiskSummary $summary = null, ?RiskDetails $details = null)
    {
        $this->checks = $checks;
        $this->lookedAt = $lookedAt;
        $this->summary = $summary;
        $this->details = $details;
    }
}