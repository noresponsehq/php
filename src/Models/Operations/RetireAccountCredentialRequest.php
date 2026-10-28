<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class RetireAccountCredentialRequest
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
     * @var string $credentialId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=credential_id')]
    public string $credentialId;

    /**
     * @param  string  $accountId
     * @param  string  $credentialId
     * @phpstan-pure
     */
    public function __construct(string $accountId, string $credentialId)
    {
        $this->accountId = $accountId;
        $this->credentialId = $credentialId;
    }
}