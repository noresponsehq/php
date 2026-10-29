<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AuditSettingsRequest
{
    /**
     *
     * @var int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    public int $retentionDays;

    /**
     * @param  int  $retentionDays
     * @phpstan-pure
     */
    public function __construct(int $retentionDays)
    {
        $this->retentionDays = $retentionDays;
    }
}