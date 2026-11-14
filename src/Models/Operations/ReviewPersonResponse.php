<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ReviewPersonResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Person $result
     */
    #[NoResponseMetadata('')]
    public Shared\Person $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Person  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Person $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}