<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use NoResponse\Models\Shared\AccountDeletedEvent;
use NoResponse\Models\Shared\AccountRiskChangedEvent;
use NoResponse\Models\Shared\Assessment;
use NoResponse\Models\Shared\AssessmentExpired;
use NoResponse\Models\Shared\AssessmentUpdatedEvent;
use NoResponse\Models\Shared\EndpointVerificationEvent;
use NoResponse\Models\Shared\Status;
use NoResponse\Models\Shared\WebhookEndpointDisabledEvent;
use NoResponse\Models\Shared\WorkspaceDeletedEvent;
use NoResponse\WebhookVerification\Webhook;

/**
 * Late-result handlers. Hand-written; not generated.
 *
 * An assessment can be revised after the account creation was allowed: a slow source
 * settles and the account's decision rises. NoResponse sends the new version
 * as a signed assessment.updated webhook. handleLateResult verifies that delivery
 * with Webhook::constructEvent, picks an action from your policy, and acts
 * through the auth provider's admin API: revoke the user's sessions or ban
 * the user. It never acts on an unverified event or a test event. Every
 * provider call treats a 404 (user or session already gone) as done, so a
 * repeated delivery is safe.
 */
final class LateResults
{
    /** Revoke sessions on review or block; do nothing on allow or step_up. Banning is opt-in. */
    public const DEFAULT_POLICY = [
        'allow' => LateResultAction::NONE,
        'step_up' => LateResultAction::NONE,
        'review' => LateResultAction::REVOKE_SESSIONS,
        'block' => LateResultAction::REVOKE_SESSIONS,
    ];

    /**
     * The action your policy names for a verified event. Only a served
     * assessment that carries the account's decision (account.risk.decision)
     * can act; a test event from the send-test-event call never does. A
     * decision the policy leaves out does nothing.
     *
     * @param  array<string, string>|null  $policy  decision => action; defaults to DEFAULT_POLICY
     *
     * @throws \InvalidArgumentException for an action other than none, revoke_sessions or ban
     */
    public static function lateResultAction(AssessmentUpdatedEvent|EndpointVerificationEvent|AccountDeletedEvent|WorkspaceDeletedEvent|WebhookEndpointDisabledEvent|AccountRiskChangedEvent $event, ?array $policy = null): string
    {
        $policy ??= self::DEFAULT_POLICY;
        // Only an assessment.updated event can be a test event or an expiry.
        if ($event instanceof AssessmentUpdatedEvent && ($event->test === true || $event->data instanceof AssessmentExpired)) {
            return LateResultAction::NONE;
        }
        $decision = null;
        if ($event instanceof AccountRiskChangedEvent) {
            // The event is sent when any flow's decision changes; sessions are about the
            // login decision, so an unchanged login decision acts on nothing.
            if ($event->data->previousDecisionsByFlow->login === $event->data->account->decisionsByFlow->login) {
                return LateResultAction::NONE;
            }
            $decision = $event->data->account->decisionsByFlow->login;
        } elseif ($event instanceof AssessmentUpdatedEvent && $event->data instanceof Assessment
            && $event->data->status !== Status::Pending) {
            $decision = $event->data->account?->risk->decision;
        }
        if ($decision === null) {
            return LateResultAction::NONE;
        }
        $action = $policy[$decision->value] ?? null;
        if ($action === null) {
            return LateResultAction::NONE;
        }
        if (! in_array($action, LateResultAction::ALL, true)) {
            throw new \InvalidArgumentException("unknown late result action {$action}");
        }

        return $action;
    }

    /**
     * Verify a webhook delivery and apply your policy to it.
     *
     * $payload, $headers, $secrets, $toleranceSeconds and $now are exactly what
     * Webhook::constructEvent takes; a delivery that fails verification throws
     * WebhookVerificationException before any provider call. Deduplicate on
     * $result->event->id and ignore versions older than one you have acted on.
     *
     * @param  array<string, string|array<string>>  $headers
     * @param  array<string, string>  $secrets
     * @param  array<string, string>|null  $policy  decision => action; defaults to DEFAULT_POLICY
     * @param  (callable(string, AssessmentUpdatedEvent|EndpointVerificationEvent|AccountDeletedEvent|WorkspaceDeletedEvent|WebhookEndpointDisabledEvent|AccountRiskChangedEvent): (string|null))|null  $userId  maps the account id to the provider user id (default: the account id itself); return null or '' to take no action
     *
     * @throws \NoResponse\WebhookVerification\WebhookVerificationException
     * @throws ProviderActionException
     */
    public static function handleLateResult(
        string $payload,
        array $headers,
        array $secrets,
        LateResultProvider $provider,
        ?array $policy = null,
        ?callable $userId = null,
        int $toleranceSeconds = Webhook::DEFAULT_TOLERANCE_SECONDS,
        ?int $now = null,
    ): LateResult {
        $event = Webhook::constructEvent($payload, $headers, $secrets, $toleranceSeconds, $now);
        $action = self::lateResultAction($event, $policy);
        if ($action === LateResultAction::NONE) {
            return new LateResult($event, LateResultAction::NONE);
        }
        if ($event instanceof AccountRiskChangedEvent) {
            $accountId = $event->data->account->id;
        } elseif ($event instanceof AssessmentUpdatedEvent && $event->data instanceof Assessment) {
            $accountId = $event->data->detail->accountId;
        } else {
            return new LateResult($event, LateResultAction::NONE);
        }
        $user = $userId === null ? $accountId : $userId($accountId, $event);
        if ($user === null || $user === '') {
            return new LateResult($event, LateResultAction::NONE);
        }
        $ran = $action;
        if ($provider instanceof LateResultActor) {
            $ran = $provider->act($action, $user);
        } elseif ($action === LateResultAction::BAN) {
            $provider->ban($user);
        } else {
            $provider->revokeSessions($user);
        }

        return new LateResult($event, $ran, $user);
    }
}
