<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Enforcement - The answer of POST /v1/accounts/{account_id}/enforcements: one enforcement of one of the calling workspace's accounts, kept once per (account, risk_version, flow, action). The first report answers 201 with the new record. A repeat answers 200 with the record as first stored, whatever the repeat's state_before, status, provider or error_code. The one exception is a stored failed record followed by an applied report: the record becomes applied, keeps its id and created_at, takes the applied report's state_before and provider, drops error_code and answers 201, so a successful retry after a failure is recorded. Only an applied record at the account's current risk_version takes the account out of GET /v1/accounts?unenforced=true. */
class Enforcement
{
    /**
     * Opaque, server-assigned id of one recorded enforcement: 'enf_' and 26 Crockford base32 characters. Unique within the workspace.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * The account_id of the request path.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * The account's risk_version the workspace acted on. It can be older than the account's current risk_version: such a record is kept and does not count for unenforced.
     *
     * @var int $riskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version')]
    public int $riskVersion;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow')]
    public Flow $flow;

    /**
     * What the workspace did in its identity provider: revoke_sessions (signed the account out everywhere), restrict (limited what the account can do), unrestrict (lifted an earlier restriction), fail_onboarding (stopped an account that was still onboarding), reject_activation (refused to activate a provisional account) or none (decided to take no action).
     *
     * @var \NoResponse\Models\Shared\EnforcementAction $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementAction')]
    public EnforcementAction $action;

    /**
     * The account's state in the workspace's identity provider just before the action: onboarding, provisional (created, not yet activated), active, restricted or rejected.
     *
     * @var \NoResponse\Models\Shared\EnforcementState $stateBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state_before')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementState')]
    public EnforcementState $stateBefore;

    /**
     * applied when the identity provider accepted the action, failed when it refused it or could not be reached. Only applied counts as enforced.
     *
     * @var \NoResponse\Models\Shared\EnforcementStatus $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementStatus')]
    public EnforcementStatus $status;

    /**
     * The identity provider the action ran in; custom for the workspace's own user store.
     *
     * @var \NoResponse\Models\Shared\EnforcementProvider $provider
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('provider')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementProvider')]
    public EnforcementProvider $provider;

    /**
     * When NoResponse first recorded this enforcement, in UTC. A failed record that becomes applied keeps it.
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * Why a failed action failed, as a short code of the workspace's choosing (lower-case letters, digits, '_', '.' and '-'), such as the identity provider's error code. Allowed only with status failed: with status applied it answers 400 invalid_request. Keep personal data out of it.
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * @param  string  $id
     * @param  string  $accountId
     * @param  int  $riskVersion
     * @param  \NoResponse\Models\Shared\Flow  $flow
     * @param  \NoResponse\Models\Shared\EnforcementAction  $action
     * @param  \NoResponse\Models\Shared\EnforcementState  $stateBefore
     * @param  \NoResponse\Models\Shared\EnforcementStatus  $status
     * @param  \NoResponse\Models\Shared\EnforcementProvider  $provider
     * @param  string  $createdAt
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(string $id, string $accountId, int $riskVersion, Flow $flow, EnforcementAction $action, EnforcementState $stateBefore, EnforcementStatus $status, EnforcementProvider $provider, string $createdAt, ?string $errorCode = null)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->riskVersion = $riskVersion;
        $this->flow = $flow;
        $this->action = $action;
        $this->stateBefore = $stateBefore;
        $this->status = $status;
        $this->provider = $provider;
        $this->createdAt = $createdAt;
        $this->errorCode = $errorCode;
    }
}