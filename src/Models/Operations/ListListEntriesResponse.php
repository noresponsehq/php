<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListListEntriesResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ListEntryList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ListEntryList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ListEntryList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ListEntryList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}