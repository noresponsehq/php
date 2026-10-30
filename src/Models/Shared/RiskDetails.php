<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RiskDetails - Detailed view only (response_mode=detailed, which needs the detailed scope); a standard answer leaves it out. Merged observations without provider, source, origin, raw breach record, value or score. */
class RiskDetails
{
    /**
     * $phoneNames
     *
     * @var ?array<\NoResponse\Models\Shared\RiskDetailsPhoneName> $phoneNames
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone_names')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskDetailsPhoneName>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $phoneNames = null;

    /**
     * The matching breach tables, newest first, at most 100.
     *
     * @var ?array<\NoResponse\Models\Shared\Breach> $breaches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('breaches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Breach>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $breaches = null;

    /**
     * Names found next to the identifiers in breach records, merged, with the number of distinct tables each was seen in and the sites of those tables.
     *
     * @var ?array<\NoResponse\Models\Shared\RiskDetailsBreachName> $breachNames
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('breach_names')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskDetailsBreachName>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $breachNames = null;

    /**
     * The identity's dated footprint events, newest first, at most 300: the year and month, what happened (created, last_active, breached), the site, its category, the kind of evidence and the identifier it belongs to. No breach value: dates are coarsened to the month.
     *
     * @var ?array<\NoResponse\Models\Shared\RiskDetailsEvent> $events
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('events')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\RiskDetailsEvent>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $events = null;

    /**
     * Every online-account search of the email or username: the platform, what the search came to and, for an account found, what the platform returned beside it. Found first, then not found, then searches that failed or are still running, each by platform name; at most 64. A failed or running search keeps its own outcome and is not reported as not_found.
     *
     * @var ?array<\NoResponse\Models\Shared\OnlineAccount> $accounts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\OnlineAccount>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $accounts = null;

    /**
     * @param  ?array<\NoResponse\Models\Shared\RiskDetailsPhoneName>  $phoneNames
     * @param  ?array<\NoResponse\Models\Shared\Breach>  $breaches
     * @param  ?array<\NoResponse\Models\Shared\RiskDetailsBreachName>  $breachNames
     * @param  ?array<\NoResponse\Models\Shared\RiskDetailsEvent>  $events
     * @param  ?array<\NoResponse\Models\Shared\OnlineAccount>  $accounts
     * @phpstan-pure
     */
    public function __construct(?array $phoneNames = null, ?array $breaches = null, ?array $breachNames = null, ?array $events = null, ?array $accounts = null)
    {
        $this->phoneNames = $phoneNames;
        $this->breaches = $breaches;
        $this->breachNames = $breachNames;
        $this->events = $events;
        $this->accounts = $accounts;
    }
}