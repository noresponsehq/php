<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountAssessmentsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AssessmentList $result
     */
    #[NoResponseMetadata('')]
    public Shared\AssessmentList $result;

    /**
     * @var \Closure(string): ?ListAccountAssessmentsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AssessmentList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AssessmentList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListAccountAssessmentsResponse
     */
    public function __call($name, $args): ?ListAccountAssessmentsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}