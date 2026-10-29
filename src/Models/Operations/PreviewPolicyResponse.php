<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class PreviewPolicyResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyPreview $result
     */
    #[NoResponseMetadata('')]
    public Shared\PolicyPreview $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PolicyPreview  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PolicyPreview $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}