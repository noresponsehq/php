<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class WrittenProfile
{
    /**
     * queued: the profile is being written. written: summary, statements and leads hold it. failed: it could not be written; error_code says why and no content is returned.
     *
     * @var \NoResponse\Models\Shared\WrittenProfileStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WrittenProfileStatus|string')]
    public WrittenProfileStatus|string $status;

    /**
     * The investigation whose evidence the profile is written from.
     *
     * @var string $investigationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('investigation_id')]
    public string $investigationId;

    /**
     *
     * @var string $queuedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('queued_at')]
    public string $queuedAt;

    /**
     * Each fact or inference with its certainty and the evidence it cites. Statements that cited evidence the writer was not sent are dropped before storage.
     *
     * @var array<\NoResponse\Models\Shared\ProfileStatement> $statements
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('statements')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ProfileStatement>')]
    public array $statements;

    /**
     * Values worth searching next, each held by a linked record.
     *
     * @var array<\NoResponse\Models\Shared\ProfileLead> $leads
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('leads')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ProfileLead>')]
    public array $leads;

    /**
     * Present only when status is failed. no_writer: no profile writer serves this environment. refused: the model refused. not_written: the answer was not a profile, or no statement survived grounding. uncited_statement: a statement or lead cited a record the person does not hold. not_answered: the writer did not answer. worker_attempts_exhausted: the worker stopped retrying.
     *
     * @var \NoResponse\Models\Shared\WrittenProfileErrorCode|string|null $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WrittenProfileErrorCode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public WrittenProfileErrorCode|string|null $errorCode = null;

    /**
     *
     * @var ?string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    public ?string $finishedAt;

    /**
     * Present when written: a few plain sentences with the most useful picture first.
     *
     * @var ?string $summary
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('summary')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $summary = null;

    /**
     * @param  \NoResponse\Models\Shared\WrittenProfileStatus|string  $status
     * @param  string  $investigationId
     * @param  string  $queuedAt
     * @param  array<\NoResponse\Models\Shared\ProfileStatement>  $statements
     * @param  array<\NoResponse\Models\Shared\ProfileLead>  $leads
     * @param  \NoResponse\Models\Shared\WrittenProfileErrorCode|string|null  $errorCode
     * @param  ?string  $finishedAt
     * @param  ?string  $summary
     * @phpstan-pure
     */
    public function __construct(WrittenProfileStatus|string $status, string $investigationId, string $queuedAt, array $statements, array $leads, WrittenProfileErrorCode|string|null $errorCode = null, ?string $finishedAt = null, ?string $summary = null)
    {
        $this->status = $status;
        $this->investigationId = $investigationId;
        $this->queuedAt = $queuedAt;
        $this->statements = $statements;
        $this->leads = $leads;
        $this->errorCode = $errorCode;
        $this->finishedAt = $finishedAt;
        $this->summary = $summary;
    }
}