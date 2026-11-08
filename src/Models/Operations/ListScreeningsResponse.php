<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListScreeningsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ScreeningList $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ScreeningList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ScreeningList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}