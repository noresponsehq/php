<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskDetailsEvent
{
    /**
     *
     * @var int $year
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('year')]
    public int $year;

    /**
     *
     * @var \NoResponse\Models\Shared\RiskDetailsEventKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskDetailsEventKind|string')]
    public RiskDetailsEventKind|string $kind;

    /**
     *
     * @var string $site
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('site')]
    public string $site;

    /**
     *
     * @var string $category
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('category')]
    public string $category;

    /**
     * The source-neutral kind of evidence: account_presence (an account found on a site), auth_provider (the account at your auth provider), breach (breach and credential tables), breach_abuse (abuse and fraud communities' tables) and code_hosting (a code hosting profile).
     *
     * @var \NoResponse\Models\Shared\FootprintFamily|string $family
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('family')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FootprintFamily|string')]
    public FootprintFamily|string $family;

    /**
     *
     * @var \NoResponse\Models\Shared\Identifier|string $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Identifier|string')]
    public Identifier|string $identifier;

    /**
     *
     * @var ?int $month
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('month')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $month = null;

    /**
     * @param  int  $year
     * @param  \NoResponse\Models\Shared\RiskDetailsEventKind|string  $kind
     * @param  string  $site
     * @param  string  $category
     * @param  \NoResponse\Models\Shared\FootprintFamily|string  $family
     * @param  \NoResponse\Models\Shared\Identifier|string  $identifier
     * @param  ?int  $month
     * @phpstan-pure
     */
    public function __construct(int $year, RiskDetailsEventKind|string $kind, string $site, string $category, FootprintFamily|string $family, Identifier|string $identifier, ?int $month = null)
    {
        $this->year = $year;
        $this->kind = $kind;
        $this->site = $site;
        $this->category = $category;
        $this->family = $family;
        $this->identifier = $identifier;
        $this->month = $month;
    }
}