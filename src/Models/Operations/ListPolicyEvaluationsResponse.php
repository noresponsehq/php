<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListPolicyEvaluationsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\PolicyEvaluationList $result
     */
    #[NoResponseMetadata('')]
    public Shared\PolicyEvaluationList $result;

    /**
     * @var \Closure(string): ?ListPolicyEvaluationsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\PolicyEvaluationList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\PolicyEvaluationList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListPolicyEvaluationsResponse
     */
    public function __call($name, $args): ?ListPolicyEvaluationsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}