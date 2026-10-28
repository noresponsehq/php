<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class GetAccountDecisionRequest
{
    /**
     * The account_id the workspace sends with its assessments, as one path segment (percent-encode '|' and ':' if the client requires it). A value that does not match the account_id shape answers 400 invalid_request.
     *
     * @var string $accountId
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=account_id')]
    public string $accountId;

    /**
     * The canonical decimal risk_version originally served.
     *
     * @var int $riskVersion
     */
    #[NoResponseMetadata('pathParam:style=simple,explode=false,name=risk_version')]
    public int $riskVersion;

    /**
     * @param  string  $accountId
     * @param  int  $riskVersion
     * @phpstan-pure
     */
    public function __construct(string $accountId, int $riskVersion)
    {
        $this->accountId = $accountId;
        $this->riskVersion = $riskVersion;
    }
}