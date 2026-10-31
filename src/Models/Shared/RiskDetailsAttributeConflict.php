<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class RiskDetailsAttributeConflict
{
    /**
     * name_gender is the records' gender against the submitted first name's usual one.
     *
     * @var \NoResponse\Models\Shared\Attribute|string $attribute
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attribute')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Attribute|string')]
    public Attribute|string $attribute;

    /**
     * The domains of the breached sites whose tables report the attribute, newest breach first, at most 32. Absent when none of the tables has a site.
     *
     * @var ?array<string> $sites
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sites')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $sites = null;

    /**
     * How many of the tables reporting the attribute have no site, such as a credential list or a stealer log. Absent when none.
     *
     * @var ?int $unsited
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('unsited')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $unsited = null;

    /**
     * @param  \NoResponse\Models\Shared\Attribute|string  $attribute
     * @param  ?array<string>  $sites
     * @param  ?int  $unsited
     * @phpstan-pure
     */
    public function __construct(Attribute|string $attribute, ?array $sites = null, ?int $unsited = null)
    {
        $this->attribute = $attribute;
        $this->sites = $sites;
        $this->unsited = $unsited;
    }
}