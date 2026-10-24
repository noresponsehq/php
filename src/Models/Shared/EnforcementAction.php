<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What the workspace did in its identity provider: revoke_sessions (signed the account out everywhere), restrict (limited what the account can do), unrestrict (lifted an earlier restriction), fail_onboarding (stopped an account that was still onboarding), reject_activation (refused to activate a provisional account) or none (decided to take no action). */
enum EnforcementAction: string
{
    case RevokeSessions = 'revoke_sessions';
    case Restrict = 'restrict';
    case Unrestrict = 'unrestrict';
    case FailOnboarding = 'fail_onboarding';
    case RejectActivation = 'reject_activation';
    case None = 'none';
}
