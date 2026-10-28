<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ExportAccountRequest
{
    /**
     * The account_id the workspace sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
     *
     * @var string $accountId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=account_id')]
    public string $accountId;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var \NoResponse\Models\Shared\ResponseMode|string|null $responseMode
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=response_mode')]
    public Shared\ResponseMode|string|null $responseMode = null;

    /**
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @phpstan-pure
     */
    public function __construct(string $accountId, Shared\ResponseMode|string|null $responseMode = null)
    {
        $this->accountId = $accountId;
        $this->responseMode = $responseMode;
    }
}