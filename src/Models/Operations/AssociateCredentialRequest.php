<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class AssociateCredentialRequest
{
    /**
     * The account_id the workspace sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
     *
     * @var string $accountId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=account_id')]
    public string $accountId;

    /**
     *
     * @var \NoResponse\Models\Shared\CredentialRequest $body
     */
    #[NoResponseMetadata('request:mediaType=application/json')]
    public Shared\CredentialRequest $body;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\CredentialRequest  $body
     * @phpstan-pure
     */
    public function __construct(string $accountId, Shared\CredentialRequest $body)
    {
        $this->accountId = $accountId;
        $this->body = $body;
    }
}