<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class RetireAccountCredentialResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\CredentialAssociation $result
     */
    #[NoResponseMetadata('')]
    public Shared\CredentialAssociation $result;

    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\CredentialAssociation  $result
     * @phpstan-pure
     */
    public function __construct(Shared\CredentialAssociation $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
}