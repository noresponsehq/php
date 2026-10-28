<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentSearchPage - A bounded page of latest assessment revisions, newest creation first. Each revision identifies the exact result found; no current account risk is attached. */
class AssessmentSearchPage
{
    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\AssessmentRevision> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\AssessmentRevision>')]
    public array $items;

    /**
     * Opaque, expiring cursor bound to this environment, operation and every filter. Keep the filters unchanged.
     *
     * @var ?string $nextCursor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_cursor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * The calling workspace's configured retention period in days. Default 365 (12 months), which is also the maximum: a workspace may only shorten it, to at least 1 day. Each record expires from its own created_at; see assessment expires_at.
     *
     * @var ?int $retentionDays
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('retention_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $retentionDays = null;

    /**
     * @param  string  $schemaVersion
     * @param  array<\NoResponse\Models\Shared\AssessmentRevision>  $items
     * @param  ?string  $nextCursor
     * @param  ?int  $retentionDays
     * @phpstan-pure
     */
    public function __construct(array $items, ?string $nextCursor = null, string $schemaVersion = '1', ?int $retentionDays = 365)
    {
        $this->items = $items;
        $this->nextCursor = $nextCursor;
        $this->schemaVersion = $schemaVersion;
        $this->retentionDays = $retentionDays;
    }
}