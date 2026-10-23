<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/**
 * The workspace was deleted. Sent once per environment before its endpoints
 * are torn down: the last event this endpoint receives. environment is
 * "live" or "test".
 */
final class WorkspaceDeleted
{
    public function __construct(
        public readonly string $workspaceId,
        public readonly string $environment,
        public readonly string $deletedAt,
    ) {
    }
}
