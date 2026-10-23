<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

use NoResponse\Models\Shared\Assessment;
use NoResponse\Webhooks\Event;
use NoResponse\Webhooks\Webhook;

/**
 * Late-result handlers. Hand-written; not generated.
 *
 * An assessment can be revised after the signup was allowed: a slow source
 * settles and the recommendation rises. NoResponse sends the new version as a
 * signed assessment.updated webhook. handleLateResult verifies that delivery
 * with Webhook::constructEvent, picks an action from your policy, and acts
 * through the auth provider's admin API: revoke the user's sessions or ban
 * the user. It never acts on an unverified event or a test event. Every
 * provider call treats a 404 (user or session already gone) as done, so a
 * repeated delivery is safe.
 */
final class LateResults
{
    /** Revoke sessions on review; do nothing on allow or step_up. Banning is opt-in. */
    public const DEFAULT_POLICY = [
        'allow' => LateResultAction::NONE,
        'step_up' => LateResultAction::NONE,
        'review' => LateResultAction::REVOKE_SESSIONS,
    ];

    /**
     * The action your policy names for a verified event. Only a served
     * assessment with a recommendation can act; a test event from the
     * send-test-event call never does. A recommendation the policy leaves out
     * does nothing.
     *
     * @param  array<string, string>|null  $policy  recommendation => action; defaults to DEFAULT_POLICY
     *
     * @throws \InvalidArgumentException for an action other than none, revoke_sessions or ban
     */
    public static function lateResultAction(Event $event, ?array $policy = null): string
    {
        $policy ??= self::DEFAULT_POLICY;
        if ($event->type !== 'assessment.updated' || $event->test || ! $event->data instanceof Assessment || $event->isExpired()) {
            return LateResultAction::NONE;
        }
        $recommendation = $event->data->recommendation ?? $event->data->risk?->recommendation;
        $recommendation = $recommendation instanceof \BackedEnum ? $recommendation->value : $recommendation;
        if (! in_array($recommendation, ['allow', 'step_up', 'review'], true)) {
            return LateResultAction::NONE;
        }
        $action = $policy[$recommendation] ?? null;
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
     * VerificationException before any provider call. Deduplicate on
     * $result->event->id and ignore versions older than one you have acted on.
     *
     * @param  array<string, string|array<string>>  $headers
     * @param  array<string, string>  $secrets
     * @param  array<string, string>|null  $policy  recommendation => action; defaults to DEFAULT_POLICY
     * @param  (callable(string, Event): (string|null))|null  $userId  maps the assessment's account_id to the provider
     *                                                                 user id; defaults to the account_id itself.
     *                                                                 Return null or '' to take no action.
     *
     * @throws \NoResponse\Webhooks\VerificationException
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
        if ($action === LateResultAction::NONE || ! $event->data instanceof Assessment) {
            return new LateResult($event, LateResultAction::NONE);
        }
        $accountId = $event->data->accountId;
        $user = $userId === null ? $accountId : $userId($accountId, $event);
        if ($user === null || $user === '') {
            return new LateResult($event, LateResultAction::NONE);
        }
        if ($action === LateResultAction::BAN) {
            $provider->ban($user);
        } else {
            $provider->revokeSessions($user);
        }

        return new LateResult($event, $action, $user);
    }
}
