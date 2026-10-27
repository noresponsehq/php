<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class CreateListEntryResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ListEntry $result
     */
    #[NoResponseMetadata('')]
    public Shared\ListEntry $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ListEntry  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ListEntry $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}