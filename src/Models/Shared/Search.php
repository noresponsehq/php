<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Search - One search a person started on a value of one of a person's records. Nothing searches again by itself. */
class Search
{
    /**
     *
     * @var string $searchId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('search_id')]
    public string $searchId;

    /**
     * The record whose value led to the search.
     *
     * @var string $recordId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('record_id')]
    public string $recordId;

    /**
     * The field of that record that holds the value.
     *
     * @var string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     * The kind of the value searched. A domain search finds the leaked rows of every email address at the domain.
     *
     * @var \NoResponse\Models\Shared\SearchKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SearchKind|string')]
    public SearchKind|string $kind;

    /**
     * The value searched: the field's cleaned value, else as the source wrote it.
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     * A password or hash search is counting, then counted: rows says how many breach rows hold the value, and nothing runs until a person runs it (POST .../searches/{search_id}/run). Any other search is queued, then running. completed: every source it asked answered. partial: some did not. failed: none answered or none could be asked, which says nothing about whether the value is held anywhere.
     *
     * @var \NoResponse\Models\Shared\SearchStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SearchStatus|string')]
    public SearchStatus|string $status;

    /**
     * How many sources the search asked: the breach search and the account and phone lookups that take the value's kind.
     *
     * @var int $sources
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sources')]
    public int $sources;

    /**
     * How many of them gave a definite answer, found or not found.
     *
     * @var int $answered
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered')]
    public int $answered;

    /**
     * How many records the search found. They are among the person report's lookup records, each match naming this search.
     *
     * @var int $found
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('found')]
    public int $found;

    /**
     * What the search may spend, in US cents, held against the environment's daily screening cap while it runs.
     *
     * @var int $estimatedSpend
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('estimated_spend')]
    public int $estimatedSpend;

    /**
     * What the search spent, in US cents, metered as screening work.
     *
     * @var int $spent
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spent')]
    public int $spent;

    /**
     * Who started the search.
     *
     * @var string $requestedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('requested_by')]
    public string $requestedBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The one breach table searched, when the search was of one table.
     *
     * @var ?string $table
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('table')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $table = null;

    /**
     * How many breach rows hold the password or hash, counted before the search runs.
     *
     * @var ?int $rows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rows')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $rows = null;

    /**
     * Why a failed search found nothing: its sources did not answer, none could be asked, or it could not run before its attempts were spent.
     *
     * @var \NoResponse\Models\Shared\ErrorCode|string|null $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ErrorCode|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ErrorCode|string|null $errorCode = null;

    /**
     *
     * @var ?string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $finishedAt = null;

    /**
     * @param  string  $searchId
     * @param  string  $recordId
     * @param  string  $field
     * @param  \NoResponse\Models\Shared\SearchKind|string  $kind
     * @param  string  $value
     * @param  \NoResponse\Models\Shared\SearchStatus|string  $status
     * @param  int  $sources
     * @param  int  $answered
     * @param  int  $found
     * @param  int  $estimatedSpend
     * @param  int  $spent
     * @param  string  $requestedBy
     * @param  string  $createdAt
     * @param  ?string  $table
     * @param  ?int  $rows
     * @param  \NoResponse\Models\Shared\ErrorCode|string|null  $errorCode
     * @param  ?string  $finishedAt
     * @phpstan-pure
     */
    public function __construct(string $searchId, string $recordId, string $field, SearchKind|string $kind, string $value, SearchStatus|string $status, int $sources, int $answered, int $found, int $estimatedSpend, int $spent, string $requestedBy, string $createdAt, ?string $table = null, ?int $rows = null, ErrorCode|string|null $errorCode = null, ?string $finishedAt = null)
    {
        $this->searchId = $searchId;
        $this->recordId = $recordId;
        $this->field = $field;
        $this->kind = $kind;
        $this->value = $value;
        $this->status = $status;
        $this->sources = $sources;
        $this->answered = $answered;
        $this->found = $found;
        $this->estimatedSpend = $estimatedSpend;
        $this->spent = $spent;
        $this->requestedBy = $requestedBy;
        $this->createdAt = $createdAt;
        $this->table = $table;
        $this->rows = $rows;
        $this->errorCode = $errorCode;
        $this->finishedAt = $finishedAt;
    }
}