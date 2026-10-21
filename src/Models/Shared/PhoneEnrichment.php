<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PhoneEnrichment - Facts about the number only: line type, carrier and country. The upstream provider, its scores and its verdicts stay internal. */
class PhoneEnrichment
{
    /**
     *
     * @var \NoResponse\Models\Shared\PhoneEnrichmentFields $fields
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('fields')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PhoneEnrichmentFields')]
    public PhoneEnrichmentFields $fields;

    /**
     * @param  \NoResponse\Models\Shared\PhoneEnrichmentFields  $fields
     * @phpstan-pure
     */
    public function __construct(PhoneEnrichmentFields $fields)
    {
        $this->fields = $fields;
    }
}