<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListCustomerExportsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportList $result
     */
    #[NoResponseMetadata('')]
    public Shared\CustomerExportList $result;

    /**
     * @var \Closure(string): ?ListCustomerExportsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\CustomerExportList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\CustomerExportList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListCustomerExportsResponse
     */
    public function __call($name, $args): ?ListCustomerExportsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}