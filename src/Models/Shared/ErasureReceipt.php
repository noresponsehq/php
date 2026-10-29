<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ErasureReceipt - Acknowledged propagation of a retained erasure record in the calling environment. Pending means the target has not acknowledged completion. Completion covers these serving-system targets only; backup and point-in-time recovery copies expire according to their own retention policy. This receipt contains no subject id or digest. Workspace teardown revokes customer credentials, so obtain required receipts before teardown. */
class ErasureReceipt
{
    /**
     * Opaque, server-issued erasure receipt id. It contains no subject identifier.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\ErasureReceiptKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ErasureReceiptKind|string')]
    public ErasureReceiptKind|string $kind;

    /**
     *
     * @var \NoResponse\Models\Shared\ListChangeState|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListChangeState|string')]
    public ListChangeState|string $status;

    /**
     *
     * @var int $assessmentsDeleted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assessments_deleted')]
    public int $assessmentsDeleted;

    /**
     *
     * @var string $requestedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('requested_at')]
    public string $requestedAt;

    /**
     * $targets
     *
     * @var array<\NoResponse\Models\Shared\ErasureReceiptTarget> $targets
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('targets')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ErasureReceiptTarget>')]
    public array $targets;

    /**
     *
     * @var string $backupPolicy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('backup_policy')]
    public string $backupPolicy;

    /**
     *
     * @var ?string $completedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('completed_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $completedAt = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\ErasureReceiptKind|string  $kind
     * @param  \NoResponse\Models\Shared\ListChangeState|string  $status
     * @param  int  $assessmentsDeleted
     * @param  string  $requestedAt
     * @param  array<\NoResponse\Models\Shared\ErasureReceiptTarget>  $targets
     * @param  string  $backupPolicy
     * @param  ?string  $completedAt
     * @phpstan-pure
     */
    public function __construct(string $id, ErasureReceiptKind|string $kind, ListChangeState|string $status, int $assessmentsDeleted, string $requestedAt, array $targets, string $backupPolicy, ?string $completedAt = null)
    {
        $this->id = $id;
        $this->kind = $kind;
        $this->status = $status;
        $this->assessmentsDeleted = $assessmentsDeleted;
        $this->requestedAt = $requestedAt;
        $this->targets = $targets;
        $this->backupPolicy = $backupPolicy;
        $this->completedAt = $completedAt;
    }
}