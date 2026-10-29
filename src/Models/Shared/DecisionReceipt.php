<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** DecisionReceipt - The decision prepared for one HTTP attempt. Its account field preserves the account decision returned for that attempt, even after subsequent changes. */
class DecisionReceipt
{
    /**
     * Opaque, server-assigned assessment id: 'asm_' and a 26-character Crockford base32 ULID. Unique within the workspace; another workspace's assessment id answers 404.
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     * Monotonic revision of this assessment. 1 on the synchronous answer; each material change while the assessment is served (an async continuation settling a source, a change of recommendation, confidence or status) increments it. Expiry does not increment it: an expired assessment is gone, not revised, and the expiry webhook carries the last served version.
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string')]
    public Flow|string $flow;

    /**
     * Processing state, separate from evidence coverage. complete: final; nothing is still running, but unsupported, failed or unanswered lanes remain in incomplete_sources. partial: a recommendation exists and evidence is incomplete; assessment_url identifies continuing work when present. pending: no recommendation yet; poll or wait for the webhook. Finished processing does not mean all sources answered.
     *
     * @var \NoResponse\Models\Shared\Status|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Status|string')]
    public Status|string $status;

    /**
     * Version of the hand-authored heuristic policy that produced the recommendation, for example 'risk-2026-10.7'. A workspace threshold override adds a +t<N> suffix, e.g. 'risk-2026-10.7+t3'.
     *
     * @var ?string $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $policyVersion = null;

    /**
     *
     * @var ?int $score
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('score')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $score = null;

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
     * @param  string  $assessmentId
     * @param  int  $assessmentVersion
     * @param  \NoResponse\Models\Shared\Flow|string  $flow
     * @param  \NoResponse\Models\Shared\Status|string  $status
     * @param  ?string  $policyVersion
     * @param  ?int  $score
     * @param  ?\NoResponse\Models\Shared\Account  $account
     * @phpstan-pure
     */
    public function __construct(string $assessmentId, int $assessmentVersion, Flow|string $flow, Status|string $status, ?string $policyVersion = null, ?int $score = null, ?Account $account = null)
    {
        $this->assessmentId = $assessmentId;
        $this->assessmentVersion = $assessmentVersion;
        $this->flow = $flow;
        $this->status = $status;
        $this->policyVersion = $policyVersion;
        $this->score = $score;
        $this->account = $account;
    }
}