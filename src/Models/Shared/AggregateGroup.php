<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AggregateGroup - One group's count in one bucket. It holds each grouped dimension the counted assessments had a value for: a pending first answer has no decision, recommendation or band; an answer that fired no reason, listed no incomplete lane, matched no list entry or whose IP has no known country or ASN leaves that dimension out. */
class AggregateGroup
{
    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * An assessment's own decision: block when its stored risk.block is true, otherwise its recommendation. It is not the account's decision or held-admission state.
     *
     * @var \NoResponse\Models\Shared\Decision|string|null $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Decision|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Decision|string|null $decision = null;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string|null $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Flow|string|null $flow = null;

    /**
     * The recommended action: allow, step_up or review. Your application applies it.
     *
     * @var \NoResponse\Models\Shared\Recommendation|string|null $recommendation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('recommendation')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Recommendation|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Recommendation|string|null $recommendation = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Band|string|null $band
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Band|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Band|string|null $band = null;

    /**
     * The list action captured with the first answer. none means no matching entry was found. For retained_first_answers an absent field means the older assessment did not capture list state; this remains a separate group.
     *
     * @var \NoResponse\Models\Shared\AggregateGroupListMatch|string|null $listMatch
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('list_match')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AggregateGroupListMatch|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public AggregateGroupListMatch|string|null $listMatch = null;

    /**
     * A stable reason code. New codes may appear; ignore any you do not know.
     *
     * @var \NoResponse\Models\Shared\ReasonCode|string|null $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReasonCode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ReasonCode|string|null $reason = null;

    /**
     * The selected reason's served impact band. Requires reason.
     *
     * @var \NoResponse\Models\Shared\Impact|string|null $impact
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('impact')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Impact|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Impact|string|null $impact = null;

    /**
     * An evidence lane: accounts (account presence for email and username), phone, breach, domain (the email domain's registration) and ip.
     *
     * @var \NoResponse\Models\Shared\Lane|string|null $lane
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lane')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Lane|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Lane|string|null $lane = null;

    /**
     *
     * @var ?string $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     *
     * @var ?int $asn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('asn')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $asn = null;

    /**
     * @param  int  $count
     * @param  \NoResponse\Models\Shared\Decision|string|null  $decision
     * @param  \NoResponse\Models\Shared\Flow|string|null  $flow
     * @param  \NoResponse\Models\Shared\Recommendation|string|null  $recommendation
     * @param  \NoResponse\Models\Shared\Band|string|null  $band
     * @param  \NoResponse\Models\Shared\AggregateGroupListMatch|string|null  $listMatch
     * @param  \NoResponse\Models\Shared\ReasonCode|string|null  $reason
     * @param  \NoResponse\Models\Shared\Impact|string|null  $impact
     * @param  \NoResponse\Models\Shared\Lane|string|null  $lane
     * @param  ?string  $country
     * @param  ?int  $asn
     * @phpstan-pure
     */
    public function __construct(int $count, Decision|string|null $decision = null, Flow|string|null $flow = null, Recommendation|string|null $recommendation = null, Band|string|null $band = null, AggregateGroupListMatch|string|null $listMatch = null, ReasonCode|string|null $reason = null, Impact|string|null $impact = null, Lane|string|null $lane = null, ?string $country = null, ?int $asn = null)
    {
        $this->count = $count;
        $this->decision = $decision;
        $this->flow = $flow;
        $this->recommendation = $recommendation;
        $this->band = $band;
        $this->listMatch = $listMatch;
        $this->reason = $reason;
        $this->impact = $impact;
        $this->lane = $lane;
        $this->country = $country;
        $this->asn = $asn;
    }
}