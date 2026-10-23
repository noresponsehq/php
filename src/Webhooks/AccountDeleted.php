<?php

declare(strict_types=1);

namespace NoResponse\Webhooks;

/**
 * An account you erased with accounts->delete: delete what you hold for it.
 * assessmentsDeleted is at least 1, and deletedAt equals deleted_at in the
 * delete answer.
 */
final class AccountDeleted
{
    public function __construct(
        public readonly string $accountId,
        public readonly int $assessmentsDeleted,
        public readonly string $deletedAt,
    ) {
    }
}
