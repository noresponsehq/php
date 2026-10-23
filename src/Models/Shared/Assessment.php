<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Assessment - One assessment, as POST /v1/assessments, GET /v1/assessments/{assessment_id} and the assessment.updated webhook return it. account is the account's one current risk: its score, the decision for this assessment's flow, the reasons and the decision for each flow. detail holds this assessment's own facts. status says whether the assessment is final (complete), usable with a source still running (partial) or not yet usable (pending). While the account's first assessment is pending, account is absent; wait for the webhook or poll the assessment. Keep the highest detail.assessment_version. */
class Assessment
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
     * @var \NoResponse\Models\Shared\Status $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status')]
    public Status $status;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow')]
    public Flow $flow;

    /**
     * How long the synchronous answer waits for sources. quick waits only for the fast sources, those that answer within 500 ms of ingress (or deadline_ms when lower); full waits for the whole budget, up to 3000 ms. Sources still running at the cut continue asynchronously and update the assessment either way.
     *
     * @var \NoResponse\Models\Shared\Depth $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Depth')]
    public Depth $depth;

    /**
     * One assessment's own facts: its score and recommendation, the signals behind them, the lanes still running and its timing. risk here is this assessment's own score; the account's current risk is the account member of the assessment. risk and recommendation are present for complete and partial; assessment_url is present for pending.
     *
     * @var \NoResponse\Models\Shared\AssessmentDetail $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentDetail')]
    public AssessmentDetail $detail;

    /**
     * Body of the 200 answer to GET /v1/accounts/{account_id}: the one current risk of one of the calling workspace's accounts. It is the risk of the account's latest assessment that has a decision (status complete or partial), by created_at and then assessment_id, scored exactly as GET /v1/assessments/{assessment_id} scores that assessment, plus the account's own reason shared_api_key when a key issued to the account was used from many IP addresses or countries (POST /v1/key_usage/batches). Its assessments are the account's history (GET /v1/accounts/{account_id}/assessments).
     *
     * @var ?\NoResponse\Models\Shared\Account $account
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Account|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Account $account = null;

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
     * @param  \NoResponse\Models\Shared\Status  $status
     * @param  \NoResponse\Models\Shared\Flow  $flow
     * @param  \NoResponse\Models\Shared\Depth  $depth
     * @param  \NoResponse\Models\Shared\AssessmentDetail  $detail
     * @param  ?\NoResponse\Models\Shared\Account  $account
     * @phpstan-pure
     */
    public function __construct(string $id, Status $status, Flow $flow, Depth $depth, AssessmentDetail $detail, ?Account $account = null, string $schemaVersion = '1')
    {
        $this->id = $id;
        $this->status = $status;
        $this->flow = $flow;
        $this->depth = $depth;
        $this->detail = $detail;
        $this->account = $account;
        $this->schemaVersion = $schemaVersion;
    }
}