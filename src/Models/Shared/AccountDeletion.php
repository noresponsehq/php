<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AccountDeletion - Body of the 200 answer to DELETE /v1/accounts/{account_id}: the calling workspace's account was erased in the environment of the calling key. Every assessment of the account went, with its revisions, evidence, outcomes and the identity-graph marks its outcomes set, and an assessment that was still running when the call arrived is stopped. Afterwards GET /v1/accounts/{account_id} and GET /v1/assessments/{assessment_id} of each erased assessment answer 404, and the history page is empty. The call is idempotent: a repeat, or an account with nothing to erase, answers 200 with assessments_deleted 0. The account_id can be assessed again later, as a new account. */
class AccountDeletion
{
    /**
     * The account_id that was erased.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * How many assessments this call deleted. 0 when the account had none left, so a repeat answers 0.
     *
     * @var int $assessmentsDeleted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessments_deleted')]
    public int $assessmentsDeleted;

    /**
     * When the erasure took effect. An assessment of the account begun before this time is refused or stopped.
     *
     * @var string $deletedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deleted_at')]
    public string $deletedAt;

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
     * @param  int  $assessmentsDeleted
     * @param  string  $deletedAt
     * @phpstan-pure
     */
    public function __construct(string $id, int $assessmentsDeleted, string $deletedAt, string $schemaVersion = '1', bool $deleted = true)
    {
        $this->id = $id;
        $this->assessmentsDeleted = $assessmentsDeleted;
        $this->deletedAt = $deletedAt;
        $this->schemaVersion = $schemaVersion;
        $this->deleted = $deleted;
    }
}