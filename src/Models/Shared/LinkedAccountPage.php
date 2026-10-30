<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** LinkedAccountPage - Other accounts in this workspace and environment whose retained assessments submitted an email, phone or customer-namespace username that one of account_id's retained assessments also submitted. Matching uses the identifier search rules: exact, canonical and, for email, mailbox. Only customer-submitted identifiers link accounts; source-discovered identifiers do not. Expired, retention-shortened, deleted and erased assessments link nothing. A shared identifier is not verified ownership. Accounts use stable opaque order, the page and total share one database snapshot, and later pages are live. Cursors bind the workspace, environment, operation and account_id, and expire. */
class LinkedAccountPage
{
    /**
     * The account whose submitted identifiers were compared. It is excluded from items.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     * $items
     *
     * @var array<\NoResponse\Models\Shared\LinkedAccount> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\LinkedAccount>')]
    public array $items;

    /**
     * Distinct linked accounts, exact below 10000 and capped at 10000.
     *
     * @var int $total
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total')]
    public int $total;

    /**
     * True when at least 10000 accounts are linked.
     *
     * @var bool $totalCapped
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total_capped')]
    public bool $totalCapped;

    /**
     * Opaque, expiring cursor bound to this environment, operation and account_id. Absent on the last page.
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
     * @param  string  $schemaVersion
     * @param  string  $accountId
     * @param  array<\NoResponse\Models\Shared\LinkedAccount>  $items
     * @param  int  $total
     * @param  bool  $totalCapped
     * @param  ?string  $nextCursor
     * @phpstan-pure
     */
    public function __construct(string $accountId, array $items, int $total, bool $totalCapped, ?string $nextCursor = null, string $schemaVersion = '1')
    {
        $this->accountId = $accountId;
        $this->items = $items;
        $this->total = $total;
        $this->totalCapped = $totalCapped;
        $this->nextCursor = $nextCursor;
        $this->schemaVersion = $schemaVersion;
    }
}