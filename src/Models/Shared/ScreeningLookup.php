<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningLookup - What the signup check's lookups found for a person: account presence for the email, phone and usernames (the person's handles), the phone lookup, the email domain's registration and the breach search. Context and coverage for the reviewer, not a finding: nothing here sets a band or a match state. */
class ScreeningLookup
{
    /**
     * Each lane each identifier was looked up in, identifiers in the order email, phone, username and lanes in the order accounts, phone, breach, domain. Every lane the person's identifiers are looked up in is listed: one that no source answered, or that no source could be asked in, is not_covered. Empty when the person has no email, phone or handle to look up.
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
     * Each source asked, with what it answered and when. answered_at is absent while the source has not answered.
     *
     * @var ?array<\NoResponse\Models\Shared\ScreeningLookupAnswer> $answers
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answers')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ScreeningLookupAnswer>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $answers = null;

    /**
     * A few typed facts per identifier: an assessment's risk.summary, and a screened person's lookup summary. Every fact is optional: absent means the evidence did not answer and makes no claim, while false or 0 is a definite answer.
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
     * What each source answered, whole, each answer once: every field of each account a connector found, and every column of each breach row the person's email or usernames matched, under the source's own names, and what each search a person started found, each match naming its search. Anyone who may read the person reads them: no extra permission applies, breach passwords and hashes included.
     *
     * @var ?array<\NoResponse\Models\Shared\Record> $records
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('records')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Record>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $records = null;

    /**
     * For each search and source whose matched rows records leave out, how many: a breach search returns at most 20 rows of a table and 100 in all, from its first 64 tables by name. A search a person starts on one table of its source fetches the rest of that table, up to 100 rows. Absent when records hold every matched row.
     *
     * @var ?array<\NoResponse\Models\Shared\RecordRemaining> $remaining
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('remaining')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RecordRemaining>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $remaining = null;

    /**
     * @param  array<\NoResponse\Models\Shared\ScreeningLookupCheck>  $checks
     * @param  string  $lookedAt
     * @param  ?array<\NoResponse\Models\Shared\ScreeningLookupAnswer>  $answers
     * @param  ?\NoResponse\Models\Shared\RiskSummary  $summary
     * @param  ?\NoResponse\Models\Shared\RiskDetails  $details
     * @param  ?array<\NoResponse\Models\Shared\Record>  $records
     * @param  ?array<\NoResponse\Models\Shared\RecordRemaining>  $remaining
     * @phpstan-pure
     */
    public function __construct(array $checks, string $lookedAt, ?array $answers = null, ?RiskSummary $summary = null, ?RiskDetails $details = null, ?array $records = null, ?array $remaining = null)
    {
        $this->checks = $checks;
        $this->lookedAt = $lookedAt;
        $this->answers = $answers;
        $this->summary = $summary;
        $this->details = $details;
        $this->records = $records;
        $this->remaining = $remaining;
    }
}