<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IpSummary - Facts about the submitted IP from the offline database and this workspace's own recent assessments. Every member is optional; absent makes no claim. */
class IpSummary
{
    /**
     * ISO 3166-1 alpha-2 country of the address.
     *
     * @var ?string $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     * The address's network type.
     *
     * @var \NoResponse\Models\Shared\IpSummaryType|string|null $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IpSummaryType|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public IpSummaryType|string|null $type = null;

    /**
     * Autonomous system number of the network that announces the address, from the offline database. Absent when unknown.
     *
     * @var ?int $asn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('asn')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $asn = null;

    /**
     * Assessments in this workspace with the same IP in the last 24 hours, this one included. A count only.
     *
     * @var ?int $seenInWorkspace
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('seen_in_workspace')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $seenInWorkspace = null;

    /**
     * @param  ?string  $country
     * @param  \NoResponse\Models\Shared\IpSummaryType|string|null  $type
     * @param  ?int  $asn
     * @param  ?int  $seenInWorkspace
     * @phpstan-pure
     */
    public function __construct(?string $country = null, IpSummaryType|string|null $type = null, ?int $asn = null, ?int $seenInWorkspace = null)
    {
        $this->country = $country;
        $this->type = $type;
        $this->asn = $asn;
        $this->seenInWorkspace = $seenInWorkspace;
    }
}