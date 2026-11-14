<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordSource - Where a record came from. */
class RecordSource
{
    /**
     * The id of the connector that read the record.
     *
     * @var string $connector
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('connector')]
    public string $connector;

    /**
     * The kind of source: platform for an account read off a live platform.
     *
     * @var string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    public string $kind;

    /**
     * The host a person knows the source's site by.
     *
     * @var ?string $site
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('site')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $site = null;

    /**
     * The table a leaked row came from.
     *
     * @var ?string $table
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('table')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $table = null;

    /**
     * When the source's data dates from, at the precision it is known.
     *
     * @var ?string $date
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('date')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $date = null;

    /**
     * @param  string  $connector
     * @param  string  $kind
     * @param  ?string  $site
     * @param  ?string  $table
     * @param  ?string  $date
     * @phpstan-pure
     */
    public function __construct(string $connector, string $kind, ?string $site = null, ?string $table = null, ?string $date = null)
    {
        $this->connector = $connector;
        $this->kind = $kind;
        $this->site = $site;
        $this->table = $table;
        $this->date = $date;
    }
}