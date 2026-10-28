<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDecisionSnapshot - Retrieve the account decision at one recorded risk version. The answer uses the original assessment and account-specific risk inputs. Earlier versions that were not captured return 404. The assessment version, policy version and account calculation version identify the decision. */
class AccountDecisionSnapshot
{
    /**
     * Body of the 200 answer to GET /v1/accounts/{account_id}: the one current risk of one of the calling workspace's accounts. It is the risk of the account's latest assessment that has a decision (status complete or partial), by created_at and then assessment_id, scored exactly as GET /v1/assessments/{assessment_id} scores that assessment, plus the account's own reason shared_api_key when a key issued to the account was used from many IP addresses or countries (POST /v1/key_usage/batches). Its assessments are the account's history (GET /v1/accounts/{account_id}/assessments).
     *
     * @var \NoResponse\Models\Shared\Account $account
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Account')]
    public Account $account;

    /**
     * Monotonic revision of this assessment. 1 on the synchronous answer; each material change while the assessment is served (an async continuation settling a source, a change of recommendation, confidence or status) increments it. Expiry does not increment it: an expired assessment is gone, not revised, and the expiry webhook carries the last served version.
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     * Version of the hand-authored heuristic policy that produced the recommendation, for example 'risk-2026-10.7'. A workspace threshold override adds a +t<N> suffix, e.g. 'risk-2026-10.7+t3'.
     *
     * @var string $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public string $policyVersion;

    /**
     *
     * @var string $changedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('changed_at')]
    public string $changedAt;

    /**
     * Opaque, server-assigned id of one recorded outcome: 'out_' and a 26-character Crockford base32 ULID. Unique within the workspace.
     *
     * @var ?string $feedbackOutcomeId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('feedback_outcome_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $feedbackOutcomeId = null;

    /**
     *
     * @var int $overlayVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('overlay_version')]
    public int $overlayVersion;

    /**
     * @param  \NoResponse\Models\Shared\Account  $account
     * @param  int  $assessmentVersion
     * @param  string  $policyVersion
     * @param  int  $overlayVersion
     * @param  string  $changedAt
     * @param  ?string  $feedbackOutcomeId
     * @phpstan-pure
     */
    public function __construct(Account $account, int $assessmentVersion, string $policyVersion, string $changedAt, ?string $feedbackOutcomeId = null, int $overlayVersion = 1)
    {
        $this->account = $account;
        $this->assessmentVersion = $assessmentVersion;
        $this->policyVersion = $policyVersion;
        $this->changedAt = $changedAt;
        $this->feedbackOutcomeId = $feedbackOutcomeId;
        $this->overlayVersion = $overlayVersion;
    }
}