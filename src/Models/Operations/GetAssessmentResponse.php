<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetAssessmentResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\Assessment $result
     */
    #[NoResponseMetadata('')]
    public Shared\Assessment $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\Assessment  $result
     * @phpstan-pure
     */
    public function __construct(Shared\Assessment $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}