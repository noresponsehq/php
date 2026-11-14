<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class JudgeRecordResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\RecordVerdict $result
     */
    #[NoResponseMetadata('')]
    public Shared\RecordVerdict $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\RecordVerdict  $result
     * @phpstan-pure
     */
    public function __construct(Shared\RecordVerdict $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}