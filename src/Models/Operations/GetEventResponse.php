<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetEventResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Event $result
     */
    #[NoResponseMetadata('')]
    public Shared\Event $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Event  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Event $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}