<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class UpdateSettingsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Settings $result
     */
    #[NoResponseMetadata('')]
    public Shared\Settings $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Settings  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Settings $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}