<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRevision - Retrieve a retained assessment version with its original decision, policy, flow and depth. This response excludes the current account decision. Current retention and response-mode permissions still apply. */
class AssessmentRevision
{
    /**
     * This assessment's id, equal to detail.assessment_id.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * complete: final; nothing is still running. A lane that failed or missed its 10 s deadline stays listed in incomplete_sources, and confidence is lower. partial: a recommendation exists and at least one lane is still running or did not settle (see incomplete_sources). pending: nothing usable before the deadline; no recommendation yet, poll or wait for the webhook.
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
     * @phpstan-pure
     */
    public function __construct(string $id, Status|string $status, Flow|string $flow, Depth|string $depth, AssessmentDetail $detail, string $schemaVersion = '1')
    {
        $this->id = $id;
        $this->status = $status;
        $this->flow = $flow;
        $this->depth = $depth;
        $this->detail = $detail;
        $this->schemaVersion = $schemaVersion;
    }
}