<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class UsageCount
{
    /**
     *
     * @var \NoResponse\Models\Shared\AuditSettingsEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AuditSettingsEnvironment|string')]
    public AuditSettingsEnvironment|string $environment;

    /**
     *
     * @var string $day
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('day')]
    public string $day;

    /**
     * assessments: assessments admitted. webhook_deliveries: events sent to endpoints, one per event per endpoint. key_usage_events: key-usage events accepted.
     *
     * @var \NoResponse\Models\Shared\Metric|string $metric
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('metric')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Metric|string')]
    public Metric|string $metric;

    /**
     *
     * @var int $count
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('count')]
    public int $count;

    /**
     * assessments only.
     *
     * @var \NoResponse\Models\Shared\UsageCountFlow|string|null $flow
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('flow')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\UsageCountFlow|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public UsageCountFlow|string|null $flow = null;

    /**
     * assessments only.
     *
     * @var \NoResponse\Models\Shared\UsageCountDepth|string|null $depth
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('depth')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\UsageCountDepth|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public UsageCountDepth|string|null $depth = null;

    /**
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $day
     * @param  \NoResponse\Models\Shared\Metric|string  $metric
     * @param  int  $count
     * @param  \NoResponse\Models\Shared\UsageCountFlow|string|null  $flow
     * @param  \NoResponse\Models\Shared\UsageCountDepth|string|null  $depth
     * @phpstan-pure
     */
    public function __construct(AuditSettingsEnvironment|string $environment, string $day, Metric|string $metric, int $count, UsageCountFlow|string|null $flow = null, UsageCountDepth|string|null $depth = null)
    {
        $this->environment = $environment;
        $this->day = $day;
        $this->metric = $metric;
        $this->count = $count;
        $this->flow = $flow;
        $this->depth = $depth;
    }
}