<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Account - Body of the 200 answer to GET /v1/accounts/{account_id}: the one current risk of one of the calling tenant's accounts. It is the risk of the account's latest assessment that has a decision (status complete or partial), by created_at and then assessment_id, scored exactly as GET /v1/assessments/{assessment_id} scores that assessment. Its assessments are the account's history (GET /v1/accounts/{account_id}/assessments). */
class Account
{
    /**
     * The account_id the tenant sends with its assessments.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountRisk $risk
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountRisk')]
    public AccountRisk $risk;

    /**
     * The decision for each flow. Every flow uses the tenant's signup thresholds today, so all three are equal.
     *
     * @var \NoResponse\Models\Shared\AccountDecisionsByFlow $decisionsByFlow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decisions_by_flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountDecisionsByFlow')]
    public AccountDecisionsByFlow $decisionsByFlow;

    /**
     * The assessment the current risk comes from.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * updated_at of that assessment's latest revision.
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

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
     * @param  \NoResponse\Models\Shared\AccountRisk  $risk
     * @param  \NoResponse\Models\Shared\AccountDecisionsByFlow  $decisionsByFlow
     * @param  string  $assessmentId
     * @param  string  $updatedAt
     * @phpstan-pure
     */
    public function __construct(string $id, AccountRisk $risk, AccountDecisionsByFlow $decisionsByFlow, string $assessmentId, string $updatedAt, string $schemaVersion = '1')
    {
        $this->id = $id;
        $this->risk = $risk;
        $this->decisionsByFlow = $decisionsByFlow;
        $this->assessmentId = $assessmentId;
        $this->updatedAt = $updatedAt;
        $this->schemaVersion = $schemaVersion;
    }
}