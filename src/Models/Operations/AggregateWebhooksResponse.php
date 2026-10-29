<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AggregateWebhooksResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\OperationalAggregate $result
     */
    #[NoResponseMetadata('')]
    public Shared\OperationalAggregate $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\OperationalAggregate  $result
     * @phpstan-pure
     */
    public function __construct(Shared\OperationalAggregate $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}