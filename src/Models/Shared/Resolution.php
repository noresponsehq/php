<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Resolution
{
    /**
     *
     * @var int $reviewVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_version')]
    public int $reviewVersion;

    /**
     *
     * @var int $riskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version')]
    public int $riskVersion;

    /**
     *
     * @var int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    public int $assessmentVersion;

    /**
     *
     * @var string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    public string $assessmentId;

    /**
     *
     * @var \NoResponse\Models\Shared\Conclusion|string $conclusion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('conclusion')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Conclusion|string')]
    public Conclusion|string $conclusion;

    /**
     *
     * @var string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    public string $note;

    /**
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * @param  int  $reviewVersion
     * @param  int  $riskVersion
     * @param  int  $assessmentVersion
     * @param  string  $assessmentId
     * @param  \NoResponse\Models\Shared\Conclusion|string  $conclusion
     * @param  string  $note
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @phpstan-pure
     */
    public function __construct(int $reviewVersion, int $riskVersion, int $assessmentVersion, string $assessmentId, Conclusion|string $conclusion, string $note, string $createdBy, string $createdAt)
    {
        $this->reviewVersion = $reviewVersion;
        $this->riskVersion = $riskVersion;
        $this->assessmentVersion = $assessmentVersion;
        $this->assessmentId = $assessmentId;
        $this->conclusion = $conclusion;
        $this->note = $note;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }
}