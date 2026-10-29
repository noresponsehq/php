<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateMemberResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Member $result
     */
    #[NoResponseMetadata('')]
    public Shared\Member $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Member  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Member $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}