<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountEnforcementsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountEnforcementList $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountEnforcementList $result;

    /**
     * @var \Closure(string): ?ListAccountEnforcementsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountEnforcementList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountEnforcementList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListAccountEnforcementsResponse
     */
    public function __call($name, $args): ?ListAccountEnforcementsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}