<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListLinkedAccountsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\LinkedAccountPage $result
     */
    #[NoResponseMetadata('')]
    public Shared\LinkedAccountPage $result;

    /**
     * @var \Closure(string): ?ListLinkedAccountsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\LinkedAccountPage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\LinkedAccountPage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListLinkedAccountsResponse
     */
    public function __call($name, $args): ?ListLinkedAccountsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}