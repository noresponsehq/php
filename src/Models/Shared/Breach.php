<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Breach - One breach table that matched, detailed view only. name is the catalogue's display name for the table's site, not the upstream provider. No member carries a record, value, password or hash. */
class Breach
{
    /**
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * Who is in the table: site_breach, a site's own users; credential_list, a combolist or compilation; stealer_log, malware or botnet victims; scrape; hacking_forum, a criminal hacking, cracking or carding community; abuse_service, the customers of DDoS-for-hire, account generators, dump or card shops, darknet markets, stalkerware or breach-lookup services; darkweb_site, an onion site of unknown purpose.
     *
     * @var \NoResponse\Models\Shared\BreachKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\BreachKind|string')]
    public BreachKind|string $kind;

    /**
     * The submitted email or username whose own search matched the table. A submitted full name is searched as well, and what it finds feeds the identity's reasons rather than this list.
     *
     * @var \NoResponse\Models\Shared\BreachSelector|string $matchedOn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_on')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\BreachSelector|string')]
    public BreachSelector|string $matchedOn;

    /**
     * The breached site's domain, lower case. Absent when the table has none (a credential list, for example).
     *
     * @var ?string $domain
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('domain')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $domain = null;

    /**
     * The table's category from its name, lower case (social, gaming, combolist, ...).
     *
     * @var ?string $category
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('category')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $category = null;

    /**
     * A breach table's date year.
     *
     * @var ?int $year
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('year')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $year = null;

    /**
     * Absent when only the year is known.
     *
     * @var ?int $month
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('month')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $month = null;

    /**
     * $exposed
     *
     * @var array<\NoResponse\Models\Shared\BreachExposed|string>|null $exposed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('exposed')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\BreachExposed|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $exposed = null;

    /**
     * What this table's rows record against the matched email or username: the tables behind the forum_sanctioned and prior_payment_abuse reasons. Absent when the rows record none, for a table matched on an IP address, and from an answer stored before it was recorded.
     *
     * @var array<\NoResponse\Models\Shared\BreachConduct|string>|null $conduct
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('conduct')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\BreachConduct|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $conduct = null;

    /**
     * @param  string  $name
     * @param  \NoResponse\Models\Shared\BreachKind|string  $kind
     * @param  \NoResponse\Models\Shared\BreachSelector|string  $matchedOn
     * @param  ?string  $domain
     * @param  ?string  $category
     * @param  ?int  $year
     * @param  ?int  $month
     * @param  array<\NoResponse\Models\Shared\BreachExposed|string>|null  $exposed
     * @param  array<\NoResponse\Models\Shared\BreachConduct|string>|null  $conduct
     * @phpstan-pure
     */
    public function __construct(string $name, BreachKind|string $kind, BreachSelector|string $matchedOn, ?string $domain = null, ?string $category = null, ?int $year = null, ?int $month = null, ?array $exposed = null, ?array $conduct = null)
    {
        $this->name = $name;
        $this->kind = $kind;
        $this->matchedOn = $matchedOn;
        $this->domain = $domain;
        $this->category = $category;
        $this->year = $year;
        $this->month = $month;
        $this->exposed = $exposed;
        $this->conduct = $conduct;
    }
}