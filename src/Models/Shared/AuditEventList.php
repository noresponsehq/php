<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AuditEventList - GET /v1/workspaces/{workspace_id}/audit_events: one page of the workspace's audit log, both environments, newest first. Events are kept for as long as the workspace exists and are deleted with it. next_cursor is present only when another page exists. */
class AuditEventList
{
    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AuditEvent> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AuditEvent>')]
    public array $items;

    /**
     * Opaque cursor for the next page, MAC'd by the server and bound to the workspace it was issued for. Pass it back unchanged as cursor; a tampered, foreign or expired cursor answers 400 invalid_cursor.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * @param  string  $workspaceId
     * @param  array<\NoResponse\Models\Shared\AuditEvent>  $items
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, array $items, ?string $nextCursor = null)
    {
        $this->workspaceId = $workspaceId;
        $this->items = $items;
        $this->nextCursor = $nextCursor;
    }
}