<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningLookupCheck - What came of one lane of the lookups for one identifier. */
class ScreeningLookupCheck
{
    /**
     *
     * @var \NoResponse\Models\Shared\IdentifierSearchKind|string $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearchKind|string')]
    public IdentifierSearchKind|string $identifier;

    /**
     * An evidence lane: accounts (account presence for email and username), phone, breach, domain (the email domain's registration) and ip.
     *
     * @var \NoResponse\Models\Shared\Lane|string $lane
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lane')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Lane|string')]
    public Lane|string $lane;

    /**
     * found: a source found the identifier. not_found: every source answered and none found it. partial: the sources that answered found nothing and the others did not answer. not_covered: no source answered. A lookup that failed reads partial or not_covered, not not_found.
     *
     * @var \NoResponse\Models\Shared\ScreeningLookupCheckStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningLookupCheckStatus|string')]
    public ScreeningLookupCheckStatus|string $status;

    /**
     * Sources asked: none when no source could be, as when the source is stopped or your workspace refuses it.
     *
     * @var int $sources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sources')]
    public int $sources;

    /**
     * Sources that gave a definite answer.
     *
     * @var int $answered
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     * Sources that found the identifier.
     *
     * @var int $found
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('found')]
    public int $found;

    /**
     * Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it.
     *
     * @var \NoResponse\Models\Shared\FailureReason|string|null $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FailureReason|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public FailureReason|string|null $reason = null;

    /**
     * @param  \NoResponse\Models\Shared\IdentifierSearchKind|string  $identifier
     * @param  \NoResponse\Models\Shared\Lane|string  $lane
     * @param  \NoResponse\Models\Shared\ScreeningLookupCheckStatus|string  $status
     * @param  int  $sources
     * @param  int  $answered
     * @param  int  $found
     * @param  \NoResponse\Models\Shared\FailureReason|string|null  $reason
     * @phpstan-pure
     */
    public function __construct(IdentifierSearchKind|string $identifier, Lane|string $lane, ScreeningLookupCheckStatus|string $status, int $sources, int $answered, int $found, FailureReason|string|null $reason = null)
    {
        $this->identifier = $identifier;
        $this->lane = $lane;
        $this->status = $status;
        $this->sources = $sources;
        $this->answered = $answered;
        $this->found = $found;
        $this->reason = $reason;
    }
}