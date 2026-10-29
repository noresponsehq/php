<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyEvaluationPublishRequest
{
    /**
     *
     * @var int $expectedPolicyVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_policy_version')]
    public int $expectedPolicyVersion;

    /**
     *
     * @var string $manifestSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('manifest_sha256')]
    public string $manifestSha256;

    /**
     *
     * @var string $inputSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('input_sha256')]
    public string $inputSha256;

    /**
     *
     * @var string $resultSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('result_sha256')]
    public string $resultSha256;

    /**
     *
     * @var \NoResponse\Models\Shared\Thresholds $candidate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('candidate')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Thresholds')]
    public Thresholds $candidate;

    /**
     *
     * @var string $changeReason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('change_reason')]
    public string $changeReason;

    /**
     * @param  int  $expectedPolicyVersion
     * @param  string  $manifestSha256
     * @param  string  $inputSha256
     * @param  string  $resultSha256
     * @param  \NoResponse\Models\Shared\Thresholds  $candidate
     * @param  string  $changeReason
     * @phpstan-pure
     */
    public function __construct(int $expectedPolicyVersion, string $manifestSha256, string $inputSha256, string $resultSha256, Thresholds $candidate, string $changeReason)
    {
        $this->expectedPolicyVersion = $expectedPolicyVersion;
        $this->manifestSha256 = $manifestSha256;
        $this->inputSha256 = $inputSha256;
        $this->resultSha256 = $resultSha256;
        $this->candidate = $candidate;
        $this->changeReason = $changeReason;
    }
}