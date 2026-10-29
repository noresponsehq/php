<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentSearchRequest - Search retained assessments created in [from,to), at most 366 days. identifier matches the submitted value of each returned assessment directly. The legacy email filter keeps its account-wide mailbox semantics and cannot be combined with identifier. Other filters combine using AND and describe assessment decisions, separate from current account decisions. Results use newest-created order with an assessment-ID tie break and are live, not a snapshot across pages. Requires history or investigate authority; identifier/email filtering also requires identifier-read permission. Detailed response mode additionally requires detailed permission. No Idempotency-Key. */
class AssessmentSearchRequest
{
    /**
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id} and its /assessments. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var ?string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountId = null;

    /**
     * Assessments of every account that one of its retained admitted assessments sent this mailbox as identifiers.email, matched as lists match an email entry: case-insensitive, a +tag removed and, at gmail.com and googlemail.com, the dots of the local part ignored. Only assessments stored since email list matching began carry the mailbox. An address that is not a valid mailbox is refused with 400.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

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
     * Processing state, separate from evidence coverage. complete: final; nothing is still running, but unsupported, failed or unanswered lanes remain in incomplete_sources. partial: a recommendation exists and evidence is incomplete; assessment_url identifies continuing work when present. pending: no recommendation yet; poll or wait for the webhook. Finished processing does not mean all sources answered.
     *
     * @var \NoResponse\Models\Shared\Status|string|null $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Status|string|null $status = null;

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
     * Opaque, expiring cursor bound to this environment, operation and every filter. Keep the filters unchanged.
     *
     * @var ?string $cursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cursor = null;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var \NoResponse\Models\Shared\ResponseMode|string|null $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ResponseMode|string|null $responseMode = null;

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
     * Which answer of each assessment the filters describe: latest, the latest stored revision, or first, the first answer, as served when the assessment was first answered (POST /v1/assessments/aggregate counts first answers). A cell of an aggregate drills down to POST /v1/assessments/search with the same filters, revision first and the cell's bucket as from and to.
     *
     * @var ?\NoResponse\Models\Shared\AnswerRevision $revision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('revision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AnswerRevision|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AnswerRevision $revision = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Band|string|null $band
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Band|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Band|string|null $band = null;

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
     * Inclusive lower score bound. Pending answers without a score do not match.
     *
     * @var ?int $scoreMin
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_min')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $scoreMin = null;

    /**
     * Inclusive upper score bound, at least score_min when both are supplied.
     *
     * @var ?int $scoreMax
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score_max')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $scoreMax = null;

    /**
     * The list action captured at the first answer. Requires revision first. Older answers without captured list state do not match, including none.
     *
     * @var ?\NoResponse\Models\Shared\ListMatch $listMatch
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('list_match')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListMatch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ListMatch $listMatch = null;

    /**
     * true returns only assessments whose latest stored revision's decision differs from their first answer's decision (see decision); false only the others. An assessment whose first answer or latest revision has no decision yet is not changed. Cannot be combined with revision first.
     *
     * @var ?bool $changed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('changed')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $changed = null;

    /**
     * One customer-submitted identifier. Defaults to exact comparison of the original submitted value. canonical uses the supported identifier normalisation without an ownership claim: email preserves local-part case, NFC-normalises it and lowercases the domain without removing dots or tags; phone uses international E.164 without extensions or an inferred region; username uses NFC and Unicode case folding within the customer namespace. mailbox is email-only and explicitly selects existing list rules: case-insensitive, remove +tag, and ignore local-part dots at gmail.com and googlemail.com; googlemail.com maps to gmail.com. Username requires namespace customer. Email and phone forbid namespace. Source-discovered identifiers and platform handles are not searched. Unsupported kinds, namespaces, modes and invalid values return 400. Search equality does not establish verified ownership or merge accounts.
     *
     * @var ?\NoResponse\Models\Shared\IdentifierSearch $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierSearch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IdentifierSearch $identifier = null;

    /**
     *
     * @var ?int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $limit = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  ?string  $accountId
     * @param  ?string  $email
     * @param  \NoResponse\Models\Shared\Flow|string|null  $flow
     * @param  \NoResponse\Models\Shared\Status|string|null  $status
     * @param  \NoResponse\Models\Shared\Recommendation|string|null  $recommendation
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @param  \NoResponse\Models\Shared\Decision|string|null  $decision
     * @param  ?\NoResponse\Models\Shared\AnswerRevision  $revision
     * @param  \NoResponse\Models\Shared\Band|string|null  $band
     * @param  \NoResponse\Models\Shared\ReasonCode|string|null  $reason
     * @param  \NoResponse\Models\Shared\Impact|string|null  $impact
     * @param  \NoResponse\Models\Shared\Lane|string|null  $lane
     * @param  ?string  $country
     * @param  ?int  $asn
     * @param  ?int  $scoreMin
     * @param  ?int  $scoreMax
     * @param  ?\NoResponse\Models\Shared\ListMatch  $listMatch
     * @param  ?bool  $changed
     * @param  ?\NoResponse\Models\Shared\IdentifierSearch  $identifier
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, ?string $accountId = null, ?string $email = null, Flow|string|null $flow = null, Status|string|null $status = null, Recommendation|string|null $recommendation = null, ?string $cursor = null, ResponseMode|string|null $responseMode = null, Decision|string|null $decision = null, ?AnswerRevision $revision = null, Band|string|null $band = null, ReasonCode|string|null $reason = null, Impact|string|null $impact = null, Lane|string|null $lane = null, ?string $country = null, ?int $asn = null, ?int $scoreMin = null, ?int $scoreMax = null, ?ListMatch $listMatch = null, ?bool $changed = null, ?IdentifierSearch $identifier = null, ?int $limit = 20)
    {
        $this->from = $from;
        $this->to = $to;
        $this->accountId = $accountId;
        $this->email = $email;
        $this->flow = $flow;
        $this->status = $status;
        $this->recommendation = $recommendation;
        $this->cursor = $cursor;
        $this->responseMode = $responseMode;
        $this->decision = $decision;
        $this->revision = $revision;
        $this->band = $band;
        $this->reason = $reason;
        $this->impact = $impact;
        $this->lane = $lane;
        $this->country = $country;
        $this->asn = $asn;
        $this->scoreMin = $scoreMin;
        $this->scoreMax = $scoreMax;
        $this->listMatch = $listMatch;
        $this->changed = $changed;
        $this->identifier = $identifier;
        $this->limit = $limit;
    }
}