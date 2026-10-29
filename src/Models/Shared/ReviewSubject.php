<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewSubject - A tenant-local investigation link. risk_version is the account risk version captured when the link was added. It does not assert a relationship or change feedback or enforcement. */
class ReviewSubject
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewSubjectKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewSubjectKind|string')]
    public ReviewSubjectKind|string $kind;

    /**
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     *
     * @var int $riskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version')]
    public int $riskVersion;

    /**
     *
     * @var string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    public string $reason;

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
     *
     * @var ?string $assessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assessmentId = null;

    /**
     *
     * @var ?int $assessmentVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessment_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $assessmentVersion = null;

    /**
     *
     * @var ?string $credentialId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('credential_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $credentialId = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\ReviewSubjectKind|string  $kind
     * @param  string  $accountId
     * @param  int  $riskVersion
     * @param  string  $reason
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @param  ?string  $assessmentId
     * @param  ?int  $assessmentVersion
     * @param  ?string  $credentialId
     * @phpstan-pure
     */
    public function __construct(string $id, ReviewSubjectKind|string $kind, string $accountId, int $riskVersion, string $reason, string $createdBy, string $createdAt, ?string $assessmentId = null, ?int $assessmentVersion = null, ?string $credentialId = null)
    {
        $this->id = $id;
        $this->kind = $kind;
        $this->accountId = $accountId;
        $this->riskVersion = $riskVersion;
        $this->reason = $reason;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
        $this->assessmentId = $assessmentId;
        $this->assessmentVersion = $assessmentVersion;
        $this->credentialId = $credentialId;
    }
}