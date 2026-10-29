<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskDetailsBreachName
{
    /**
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     *
     * @var int $seenIn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('seen_in')]
    public int $seenIn;

    /**
     * The domains of the breached sites whose tables hold the name, lower case, each once, newest breach first, at most 32: the domain values of breaches[]. Covers the email's and the username's tables together. Absent when none of the tables has a site.
     *
     * @var ?array<string> $sites
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sites')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $sites = null;

    /**
     * How many of the tables that hold the name have no site, such as a credential list or a stealer log. Absent when none.
     *
     * @var ?int $unsited
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unsited')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $unsited = null;

    /**
     * @param  string  $value
     * @param  int  $seenIn
     * @param  ?array<string>  $sites
     * @param  ?int  $unsited
     * @phpstan-pure
     */
    public function __construct(string $value, int $seenIn, ?array $sites = null, ?int $unsited = null)
    {
        $this->value = $value;
        $this->seenIn = $seenIn;
        $this->sites = $sites;
        $this->unsited = $unsited;
    }
}