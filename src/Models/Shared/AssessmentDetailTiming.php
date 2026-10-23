<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AssessmentDetailTiming
{
    /**
     * The budget the server applied to the synchronous answer.
     *
     * @var int $deadlineMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('deadline_ms')]
    public int $deadlineMs;

    /**
     * Server time from HTTP ingress to this revision of the assessment.
     *
     * @var int $elapsedMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('elapsed_ms')]
    public int $elapsedMs;

    /**
     * @param  int  $deadlineMs
     * @param  int  $elapsedMs
     * @phpstan-pure
     */
    public function __construct(int $deadlineMs, int $elapsedMs)
    {
        $this->deadlineMs = $deadlineMs;
        $this->elapsedMs = $elapsedMs;
    }
}