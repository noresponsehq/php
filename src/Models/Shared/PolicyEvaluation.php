<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyEvaluation
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluationStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PolicyEvaluationStatus|string')]
    public PolicyEvaluationStatus|string $status;

    /**
     *
     * @var int $policyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('policy_version')]
    public int $policyVersion;

    /**
     *
     * @var string $scoringPolicy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scoring_policy')]
    public string $scoringPolicy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var int $accounts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accounts')]
    public int $accounts;

    /**
     *
     * @var int $requests
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('requests')]
    public int $requests;

    /**
     *
     * @var string $evaluatorSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluator_sha256')]
    public string $evaluatorSha256;

    /**
     *
     * @var ?string $capturedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('captured_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $capturedAt = null;

    /**
     *
     * @var ?string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $finishedAt = null;

    /**
     *
     * @var ?string $buildVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('build_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $buildVersion = null;

    /**
     *
     * @var \NoResponse\Models\Shared\ResultStatus|string|null $resultStatus
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('result_status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResultStatus|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ResultStatus|string|null $resultStatus = null;

    /**
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     *
     * @var ?int $publishedPolicyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('published_policy_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $publishedPolicyVersion = null;

    /**
     *
     * @var ?string $manifestSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('manifest_sha256')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $manifestSha256 = null;

    /**
     *
     * @var ?string $inputSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('input_sha256')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $inputSha256 = null;

    /**
     *
     * @var ?string $cohortSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cohort_sha256')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $cohortSha256 = null;

    /**
     *
     * @var ?string $resultSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('result_sha256')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $resultSha256 = null;

    /**
     *
     * @var string $evaluatorVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluator_version')]
    public string $evaluatorVersion;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  \NoResponse\Models\Shared\PolicyEvaluationStatus|string  $status
     * @param  int  $policyVersion
     * @param  string  $scoringPolicy
     * @param  string  $createdAt
     * @param  string  $expiresAt
     * @param  int  $accounts
     * @param  int  $requests
     * @param  string  $evaluatorVersion
     * @param  string  $evaluatorSha256
     * @param  ?string  $capturedAt
     * @param  ?string  $finishedAt
     * @param  ?string  $buildVersion
     * @param  \NoResponse\Models\Shared\ResultStatus|string|null  $resultStatus
     * @param  ?string  $errorCode
     * @param  ?int  $publishedPolicyVersion
     * @param  ?string  $manifestSha256
     * @param  ?string  $inputSha256
     * @param  ?string  $cohortSha256
     * @param  ?string  $resultSha256
     * @phpstan-pure
     */
    public function __construct(string $id, AuditSettingsEnvironment|string $environment, PolicyEvaluationStatus|string $status, int $policyVersion, string $scoringPolicy, string $createdAt, string $expiresAt, int $accounts, int $requests, string $evaluatorSha256, ?string $capturedAt = null, ?string $finishedAt = null, ?string $buildVersion = null, ResultStatus|string|null $resultStatus = null, ?string $errorCode = null, ?int $publishedPolicyVersion = null, ?string $manifestSha256 = null, ?string $inputSha256 = null, ?string $cohortSha256 = null, ?string $resultSha256 = null, string $evaluatorVersion = 'identity-threshold-evaluator-v2')
    {
        $this->id = $id;
        $this->environment = $environment;
        $this->status = $status;
        $this->policyVersion = $policyVersion;
        $this->scoringPolicy = $scoringPolicy;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->accounts = $accounts;
        $this->requests = $requests;
        $this->evaluatorSha256 = $evaluatorSha256;
        $this->capturedAt = $capturedAt;
        $this->finishedAt = $finishedAt;
        $this->buildVersion = $buildVersion;
        $this->resultStatus = $resultStatus;
        $this->errorCode = $errorCode;
        $this->publishedPolicyVersion = $publishedPolicyVersion;
        $this->manifestSha256 = $manifestSha256;
        $this->inputSha256 = $inputSha256;
        $this->cohortSha256 = $cohortSha256;
        $this->resultSha256 = $resultSha256;
        $this->evaluatorVersion = $evaluatorVersion;
    }
}