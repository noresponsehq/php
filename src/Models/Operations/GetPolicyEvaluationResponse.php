<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class GetPolicyEvaluationResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluation $result
     */
    #[NoResponseMetadata('')]
    public Shared\PolicyEvaluation $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PolicyEvaluation  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PolicyEvaluation $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}