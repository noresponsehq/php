<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Report
{
    /**
     *
     * @var string $inputSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('input_sha256')]
    public string $inputSha256;

    /**
     *
     * @var string $cohortSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cohort_sha256')]
    public string $cohortSha256;

    /**
     *
     * @var \NoResponse\Models\Shared\ResultStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResultStatus|string')]
    public ResultStatus|string $status;

    /**
     *
     * @var \NoResponse\Models\Shared\Thresholds $candidate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('candidate')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Thresholds')]
    public Thresholds $candidate;

    /**
     *
     * @var \NoResponse\Models\Shared\ReportScope $scope
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scope')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReportScope')]
    public ReportScope $scope;

    /**
     *
     * @var string $evaluatorVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluator_version')]
    public string $evaluatorVersion;

    /**
     * @param  string  $evaluatorVersion
     * @param  string  $inputSha256
     * @param  string  $cohortSha256
     * @param  \NoResponse\Models\Shared\ResultStatus|string  $status
     * @param  \NoResponse\Models\Shared\Thresholds  $candidate
     * @param  \NoResponse\Models\Shared\ReportScope  $scope
     * @phpstan-pure
     */
    public function __construct(string $inputSha256, string $cohortSha256, ResultStatus|string $status, Thresholds $candidate, ReportScope $scope, string $evaluatorVersion = 'identity-threshold-evaluator-v2')
    {
        $this->inputSha256 = $inputSha256;
        $this->cohortSha256 = $cohortSha256;
        $this->status = $status;
        $this->candidate = $candidate;
        $this->scope = $scope;
        $this->evaluatorVersion = $evaluatorVersion;
    }
}