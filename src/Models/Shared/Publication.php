<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Publication - Immutable publication provenance remains in policy history after evaluation evidence expires. SHA-256 values identify the frozen manifest, evaluator semantic input, cohort, and canonical result separately. */
class Publication
{
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
     * @var string $cohortSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('cohort_sha256')]
    public string $cohortSha256;

    /**
     *
     * @var string $resultSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('result_sha256')]
    public string $resultSha256;

    /**
     *
     * @var string $evaluatorSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluator_sha256')]
    public string $evaluatorSha256;

    /**
     *
     * @var string $evaluationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluation_id')]
    public string $evaluationId;

    /**
     *
     * @var string $buildVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('build_version')]
    public string $buildVersion;

    /**
     *
     * @var string $capturedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('captured_at')]
    public string $capturedAt;

    /**
     *
     * @var string $publishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('published_at')]
    public string $publishedAt;

    /**
     *
     * @var string $evaluatorVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evaluator_version')]
    public string $evaluatorVersion;

    /**
     * @param  string  $manifestSha256
     * @param  string  $inputSha256
     * @param  string  $cohortSha256
     * @param  string  $resultSha256
     * @param  string  $evaluatorSha256
     * @param  string  $evaluationId
     * @param  string  $evaluatorVersion
     * @param  string  $buildVersion
     * @param  string  $capturedAt
     * @param  string  $publishedAt
     * @phpstan-pure
     */
    public function __construct(string $manifestSha256, string $inputSha256, string $cohortSha256, string $resultSha256, string $evaluatorSha256, string $evaluationId, string $buildVersion, string $capturedAt, string $publishedAt, string $evaluatorVersion = 'identity-threshold-evaluator-v2')
    {
        $this->manifestSha256 = $manifestSha256;
        $this->inputSha256 = $inputSha256;
        $this->cohortSha256 = $cohortSha256;
        $this->resultSha256 = $resultSha256;
        $this->evaluatorSha256 = $evaluatorSha256;
        $this->evaluationId = $evaluationId;
        $this->buildVersion = $buildVersion;
        $this->capturedAt = $capturedAt;
        $this->publishedAt = $publishedAt;
        $this->evaluatorVersion = $evaluatorVersion;
    }
}