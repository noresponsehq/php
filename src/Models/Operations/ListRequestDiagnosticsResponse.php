<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListRequestDiagnosticsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\RequestDiagnosticPage $result
     */
    #[NoResponseMetadata('')]
    public Shared\RequestDiagnosticPage $result;

    /**
     * @var \Closure(string): ?ListRequestDiagnosticsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\RequestDiagnosticPage  $result
     * @phpstan-pure
     */
    public function __construct(Shared\RequestDiagnosticPage $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListRequestDiagnosticsResponse
     */
    public function __call($name, $args): ?ListRequestDiagnosticsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}