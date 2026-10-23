<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AssessmentDeletionAccount
{
    /**
     * The account_id of the deleted assessment.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * The assessment the account's current risk now comes from. Absent when the account has no assessment with a decision left, and GET /v1/accounts/{account_id} then answers 404.
     *
     * @var ?string $currentAssessmentId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('current_assessment_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $currentAssessmentId = null;

    /**
     * @param  string  $id
     * @param  ?string  $currentAssessmentId
     * @phpstan-pure
     */
    public function __construct(string $id, ?string $currentAssessmentId = null)
    {
        $this->id = $id;
        $this->currentAssessmentId = $currentAssessmentId;
    }
}