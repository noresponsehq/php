<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentList - Body of the 200 answer to POST /v1/assessments/query: one page of the calling tenant's unexpired assessments for one account, newest first, each at its latest assessment_version. Every item's account_id equals the page's. An assessment past its expires_at is not listed. next_cursor is present only when another page exists. */
class AssessmentList
{
    /**
     * Your own opaque identifier for the account being checked, scoped to your tenant. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused, as is a JWT; a hex digest such as a SHA-256 is allowed. It travels only in request bodies.
     *
     * @var string $accountId
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\Assessment> $items
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('items')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\Assessment>')]
    public array $items;

    /**
     * Opaque cursor for the next page, bound to your tenant and the account_id it was issued for. Pass it back unchanged in the next query; a tampered, foreign or expired cursor answers 400 invalid_cursor.
     *
     * @var ?string $nextCursor
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('next_cursor')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $nextCursor = null;

    /**
     * Version of the body shape.
     *
     * @var string $schemaVersion
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('schema_version')]
    public string $schemaVersion;

    /**
     * Your current retention period, so a consumer knows how far back history reaches. Every item expires no later than its created_at plus this many days.
     *
     * @var ?int $retentionDays
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('retention_days')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $retentionDays = null;

    /**
     * @param  string  $schemaVersion
     * @param  string  $accountId
     * @param  array<\NoResponse\Models\Shared\Assessment>  $items
     * @param  ?string  $nextCursor
     * @param  ?int  $retentionDays
     * @phpstan-pure
     */
    public function __construct(string $accountId, array $items, ?string $nextCursor = null, string $schemaVersion = '1', ?int $retentionDays = 365)
    {
        $this->accountId = $accountId;
        $this->items = $items;
        $this->nextCursor = $nextCursor;
        $this->schemaVersion = $schemaVersion;
        $this->retentionDays = $retentionDays;
    }
}