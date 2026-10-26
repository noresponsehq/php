<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RiskSummary - A few typed facts per identifier. Every fact is optional: absent means the evidence did not answer and makes no claim, while false or 0 is a definite answer. Lanes that do not exist yet leave their members absent. */
class RiskSummary
{
    /**
     *
     * @var ?\NoResponse\Models\Shared\RiskSummaryPhone $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskSummaryPhone|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskSummaryPhone $phone = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\RiskSummaryEmail $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskSummaryEmail|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskSummaryEmail $email = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\RiskSummaryUsername $username
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('username')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RiskSummaryUsername|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?RiskSummaryUsername $username = null;

    /**
     * Facts about the submitted IP from the offline database and this workspace's own recent assessments. Every member is optional; absent makes no claim.
     *
     * @var ?\NoResponse\Models\Shared\IpSummary $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IpSummary|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?IpSummary $ip = null;

    /**
     * Cross-identifier agreement, computed from facts only. Every member is optional; absent makes no claim.
     *
     * @var ?\NoResponse\Models\Shared\Consistency $consistency
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('consistency')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Consistency|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Consistency $consistency = null;

    /**
     * How long and how widely the signup's email and username have existed, and how far independent sources agree on the person behind them, in years and counts only. families are the kinds of evidence that found either identifier. Omitted when nothing found them: a footprint lookup that failed makes no claim, and absence is no_digital_footprint's to state.
     *
     * @var ?\NoResponse\Models\Shared\Footprint $footprint
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('footprint')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Footprint|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Footprint $footprint = null;

    /**
     * @param  ?\NoResponse\Models\Shared\RiskSummaryPhone  $phone
     * @param  ?\NoResponse\Models\Shared\RiskSummaryEmail  $email
     * @param  ?\NoResponse\Models\Shared\RiskSummaryUsername  $username
     * @param  ?\NoResponse\Models\Shared\IpSummary  $ip
     * @param  ?\NoResponse\Models\Shared\Consistency  $consistency
     * @param  ?\NoResponse\Models\Shared\Footprint  $footprint
     * @phpstan-pure
     */
    public function __construct(?RiskSummaryPhone $phone = null, ?RiskSummaryEmail $email = null, ?RiskSummaryUsername $username = null, ?IpSummary $ip = null, ?Consistency $consistency = null, ?Footprint $footprint = null)
    {
        $this->phone = $phone;
        $this->email = $email;
        $this->username = $username;
        $this->ip = $ip;
        $this->consistency = $consistency;
        $this->footprint = $footprint;
    }
}