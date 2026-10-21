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
    #[\Speakeasy\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * Who is in the table: site_breach, a site's own users; credential_list, a combolist or compilation; stealer_log, malware or botnet victims; scrape; hacking_forum, a criminal hacking, cracking or carding community; abuse_service, the customers of DDoS-for-hire, account generators, dump or card shops, darknet markets, stalkerware or breach-lookup services; darkweb_site, an onion site of unknown purpose.
     *
     * @var \NoResponse\Models\Shared\BreachKind $kind
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('kind')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\BreachKind')]
    public BreachKind $kind;

    /**
     * The submitted identifier a breach table matched on: email or username. Phone and name are not breach selectors.
     *
     * @var \NoResponse\Models\Shared\BreachSelector $matchedOn
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('matched_on')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\BreachSelector')]
    public BreachSelector $matchedOn;

    /**
     * The breached site's domain, lower case. Absent when the table has none (a credential list, for example).
     *
     * @var ?string $domain
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('domain')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $domain = null;

    /**
     * The table's category from its name, lower case (social, gaming, combolist, ...).
     *
     * @var ?string $category
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('category')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $category = null;

    /**
     * A breach table's date year.
     *
     * @var ?int $year
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('year')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $year = null;

    /**
     * Absent when only the year is known.
     *
     * @var ?int $month
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('month')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $month = null;

    /**
     * $exposed
     *
     * @var ?array<\NoResponse\Models\Shared\BreachExposed> $exposed
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('exposed')]
    #[\Speakeasy\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\BreachExposed>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $exposed = null;

    /**
     * @param  string  $name
     * @param  \NoResponse\Models\Shared\BreachKind  $kind
     * @param  \NoResponse\Models\Shared\BreachSelector  $matchedOn
     * @param  ?string  $domain
     * @param  ?string  $category
     * @param  ?int  $year
     * @param  ?int  $month
     * @param  ?array<\NoResponse\Models\Shared\BreachExposed>  $exposed
     * @phpstan-pure
     */
    public function __construct(string $name, BreachKind $kind, BreachSelector $matchedOn, ?string $domain = null, ?string $category = null, ?int $year = null, ?int $month = null, ?array $exposed = null)
    {
        $this->name = $name;
        $this->kind = $kind;
        $this->matchedOn = $matchedOn;
        $this->domain = $domain;
        $this->category = $category;
        $this->year = $year;
        $this->month = $month;
        $this->exposed = $exposed;
    }
}