<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** EnforcementRequest - POST /v1/accounts/{account_id}/enforcements body: what the workspace did to the account in its identity provider after reading the account's risk at risk_version. The account is named by the path and the workspace by the API key, so neither is a body member. An enforcement is the workspace's own action, not an outcome: what the workspace later learned about an assessment goes to POST /v1/assessments/{assessment_id}/outcomes. The record's key is (account, risk_version, flow, action), so a retry of the same report is safe and needs no Idempotency-Key. */
class EnforcementRequest
{
    /**
     * The account's risk_version the workspace acted on, as read from GET /v1/accounts/{account_id}, GET /v1/accounts, an assessment answer or account.risk_changed. A version older than the account's current one is accepted and stored; a version newer than the current one answers 409 risk_version_ahead.
     *
     * @var int $riskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('risk_version')]
    public int $riskVersion;

    /**
     * The event an assessment is made for: account_creation (a user creates an account), login (a user returns to an existing account) or purchase (a payment or a credit grant). The account's risk is reported with the decision for this flow.
     *
     * @var \NoResponse\Models\Shared\Flow|string $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|string')]
    public Flow|string $flow;

    /**
     * What the workspace did in its identity provider: revoke_sessions (signed the account out everywhere), restrict (limited what the account can do), unrestrict (lifted an earlier restriction), fail_onboarding (stopped an account that was still onboarding), reject_activation (refused to activate a provisional account) or none (decided to take no action).
     *
     * @var \NoResponse\Models\Shared\EnforcementAction|string $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementAction|string')]
    public EnforcementAction|string $action;

    /**
     * The account's state in the workspace's identity provider just before the action: onboarding, provisional (created, not yet activated), active, restricted or rejected.
     *
     * @var \NoResponse\Models\Shared\EnforcementState|string $stateBefore
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state_before')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementState|string')]
    public EnforcementState|string $stateBefore;

    /**
     * applied when the identity provider accepted the action, failed when it refused it or could not be reached. Only applied counts as enforced.
     *
     * @var \NoResponse\Models\Shared\EnforcementStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementStatus|string')]
    public EnforcementStatus|string $status;

    /**
     * The identity provider the action ran in; custom for the workspace's own user store.
     *
     * @var \NoResponse\Models\Shared\EnforcementProvider|string $provider
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('provider')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\EnforcementProvider|string')]
    public EnforcementProvider|string $provider;

    /**
     * Why a failed action failed, as a short code of the workspace's choosing (lower-case letters, digits, '_', '.' and '-'), such as the identity provider's error code. Allowed only with status failed: with status applied it answers 400 invalid_request. Keep personal data out of it.
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * @param  int  $riskVersion
     * @param  \NoResponse\Models\Shared\Flow|string  $flow
     * @param  \NoResponse\Models\Shared\EnforcementAction|string  $action
     * @param  \NoResponse\Models\Shared\EnforcementState|string  $stateBefore
     * @param  \NoResponse\Models\Shared\EnforcementStatus|string  $status
     * @param  \NoResponse\Models\Shared\EnforcementProvider|string  $provider
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(int $riskVersion, Flow|string $flow, EnforcementAction|string $action, EnforcementState|string $stateBefore, EnforcementStatus|string $status, EnforcementProvider|string $provider, ?string $errorCode = null)
    {
        $this->riskVersion = $riskVersion;
        $this->flow = $flow;
        $this->action = $action;
        $this->stateBefore = $stateBefore;
        $this->status = $status;
        $this->provider = $provider;
        $this->errorCode = $errorCode;
    }
}