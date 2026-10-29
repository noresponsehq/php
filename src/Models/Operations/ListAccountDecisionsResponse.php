<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountDecisionsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountDecisionList $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountDecisionList $result;

    /**
     * @var \Closure(string): ?ListAccountDecisionsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountDecisionList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountDecisionList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListAccountDecisionsResponse
     */
    public function __call($name, $args): ?ListAccountDecisionsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}