<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetPolicyEvaluationResultResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluationResult $result
     */
    #[NoResponseMetadata('')]
    public Shared\PolicyEvaluationResult $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PolicyEvaluationResult  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PolicyEvaluationResult $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}