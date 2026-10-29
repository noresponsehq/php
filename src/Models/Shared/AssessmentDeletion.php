<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentDeletion - Body of the 200 answer to DELETE /v1/assessments/{assessment_id}: one of the calling workspace's assessments was deleted, with its versions, evidence, outcomes and the identity-graph marks its outcomes set. Afterwards GET /v1/assessments/{assessment_id} answers 404 and the assessment leaves the account's history. The account is scored again from what remains: account.current_assessment_id names the assessment GET /v1/accounts/{account_id} now serves its risk from, and is absent when the account has no assessment with a decision left. Deleting an assessment that is already gone answers 404. */
class AssessmentDeletion
{
    /**
     * The assessment that was deleted.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentDeletionAccount $account
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AssessmentDeletionAccount')]
    public AssessmentDeletionAccount $account;

    /**
     * When the deletion took effect.
     *
     * @var string $deletedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deleted_at')]
    public string $deletedAt;

    /**
     * Receipt for GET /v1/erasures/{erasure_id}, when durable storage issued one.
     *
     * @var ?string $erasureId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('erasure_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $erasureId = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     *
     * @var bool $deleted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deleted')]
    public bool $deleted;

    /**
     * @param  string  $schemaVersion
     * @param  string  $id
     * @param  bool  $deleted
     * @param  \NoResponse\Models\Shared\AssessmentDeletionAccount  $account
     * @param  string  $deletedAt
     * @param  ?string  $erasureId
     * @phpstan-pure
     */
    public function __construct(string $id, AssessmentDeletionAccount $account, string $deletedAt, ?string $erasureId = null, string $schemaVersion = '1', bool $deleted = true)
    {
        $this->id = $id;
        $this->account = $account;
        $this->deletedAt = $deletedAt;
        $this->erasureId = $erasureId;
        $this->schemaVersion = $schemaVersion;
        $this->deleted = $deleted;
    }
}