<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewSubjectRequest - An assessment link also requires assessment_id and assessment_version; an issued_credential link also requires credential_id. Every reference must belong to account_id in this environment. Other kinds reject those fields. */
class ReviewSubjectRequest
{
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
     * @var string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    public string $reason;

    /**
     *
     * @var int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    public int $expectedVersion;

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
     * @param  \NoResponse\Models\Shared\ReviewSubjectKind|string  $kind
     * @param  string  $accountId
     * @param  string  $reason
     * @param  int  $expectedVersion
     * @param  ?string  $assessmentId
     * @param  ?int  $assessmentVersion
     * @param  ?string  $credentialId
     * @phpstan-pure
     */
    public function __construct(ReviewSubjectKind|string $kind, string $accountId, string $reason, int $expectedVersion, ?string $assessmentId = null, ?int $assessmentVersion = null, ?string $credentialId = null)
    {
        $this->kind = $kind;
        $this->accountId = $accountId;
        $this->reason = $reason;
        $this->expectedVersion = $expectedVersion;
        $this->assessmentId = $assessmentId;
        $this->assessmentVersion = $assessmentVersion;
        $this->credentialId = $credentialId;
    }
}