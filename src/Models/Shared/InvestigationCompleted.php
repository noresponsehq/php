<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class InvestigationCompleted
{
    /**
     *
     * @var string $investigationId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('investigation_id')]
    public string $investigationId;

    /**
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     *
     * @var \NoResponse\Models\Shared\InvestigationCompletedStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\InvestigationCompletedStatus')]
    public InvestigationCompletedStatus $status;

    /**
     *
     * @var string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    public string $finishedAt;

    /**
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * @param  string  $investigationId
     * @param  string  $personId
     * @param  \NoResponse\Models\Shared\InvestigationCompletedStatus  $status
     * @param  string  $finishedAt
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(string $investigationId, string $personId, InvestigationCompletedStatus $status, string $finishedAt, ?string $errorCode = null)
    {
        $this->investigationId = $investigationId;
        $this->personId = $personId;
        $this->status = $status;
        $this->finishedAt = $finishedAt;
        $this->errorCode = $errorCode;
    }
}