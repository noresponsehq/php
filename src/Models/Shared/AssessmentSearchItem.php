<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentSearchItem - One stored assessment revision, exactly as GET /v1/assessments/{assessment_id}/versions/{version} returns it, with the decision of the assessment's first answer. It is not re-scored and carries no current account risk. */
class AssessmentSearchItem
{
    /**
     * This assessment's id, equal to detail.assessment_id.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Processing state, separate from evidence coverage. complete: final; nothing is still running, but unsupported, failed or unanswered lanes remain in incomplete_sources. partial: a recommendation exists and evidence is incomplete; assessment_url identifies continuing work when present. pending: no recommendation yet; poll or wait for the webhook. Finished processing does not mean all sources answered.
     *
     * @var \NoResponse\Models\Shared\Status|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string')]
    public Status|string $status;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string')]
    public Flow|string $flow;

    /**
     * How long the synchronous answer waits for sources. quick waits only for the fast sources, those that answer within 500 ms of ingress (or deadline_ms when lower); full waits for the whole budget, up to 3000 ms. Sources still running at the cut continue asynchronously and update the assessment either way.
     *
     * @var \NoResponse\Models\Shared\Depth|string $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Depth|string')]
    public Depth|string $depth;

    /**
     * One assessment's own facts: its score and recommendation, the signals behind them, the lanes still running and its timing. risk here is this assessment's own score; the account's current risk is the account member of the assessment. risk and recommendation are present for complete and partial; assessment_url is present for pending.
     *
     * @var \NoResponse\Models\Shared\AssessmentDetail $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentDetail')]
    public AssessmentDetail $detail;

    /**
     * An assessment's own decision: block when its stored risk.block is true, otherwise its recommendation. It is not the account's decision or held-admission state.
     *
     * @var \NoResponse\Models\Shared\Decision|string|null $firstDecision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('first_decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Decision|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Decision|string|null $firstDecision = null;

    /**
     * Why this result matched a typed identifier search. value is the original value submitted in assessment_id. Provenance records a customer submission, not a source discovery or verified ownership. Equality is deterministic and has no inferred confidence score. An account result names its newest retained matching assessment, which can differ from latest.
     *
     * @var ?\NoResponse\Models\Shared\IdentifierMatch $matchedIdentifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IdentifierMatch|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IdentifierMatch $matchedIdentifier = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * @param  string  $schemaVersion
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\Status|string  $status
     * @param  \NoResponse\Models\Shared\Flow|string  $flow
     * @param  \NoResponse\Models\Shared\Depth|string  $depth
     * @param  \NoResponse\Models\Shared\AssessmentDetail  $detail
     * @param  \NoResponse\Models\Shared\Decision|string|null  $firstDecision
     * @param  ?\NoResponse\Models\Shared\IdentifierMatch  $matchedIdentifier
     * @phpstan-pure
     */
    public function __construct(string $id, Status|string $status, Flow|string $flow, Depth|string $depth, AssessmentDetail $detail, Decision|string|null $firstDecision = null, ?IdentifierMatch $matchedIdentifier = null, string $schemaVersion = '1')
    {
        $this->id = $id;
        $this->status = $status;
        $this->flow = $flow;
        $this->depth = $depth;
        $this->detail = $detail;
        $this->firstDecision = $firstDecision;
        $this->matchedIdentifier = $matchedIdentifier;
        $this->schemaVersion = $schemaVersion;
    }
}