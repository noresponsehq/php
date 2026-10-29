<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListAccountCredentialsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\CredentialPage $result
     */
    #[NoResponseMetadata('')]
    public Shared\CredentialPage $result;

    /**
     * @var \Closure(string): ?ListAccountCredentialsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\CredentialPage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\CredentialPage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListAccountCredentialsResponse
     */
    public function __call($name, $args): ?ListAccountCredentialsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}