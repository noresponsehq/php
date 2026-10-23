<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class DeleteAccountResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\AccountDeletion $result
     */
    #[NoResponseMetadata('')]
    public Shared\AccountDeletion $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\AccountDeletion  $result
     * @phpstan-pure
     */
    public function __construct(Shared\AccountDeletion $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}