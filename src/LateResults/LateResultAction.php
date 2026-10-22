<?php

declare(strict_types=1);

namespace NoResponse\LateResults;

/** What to do to the user. BAN also ends every session. */
final class LateResultAction
{
    public const NONE = 'none';

    public const REVOKE_SESSIONS = 'revoke_sessions';

    public const BAN = 'ban';

    public const ALL = [self::NONE, self::REVOKE_SESSIONS, self::BAN];
}
