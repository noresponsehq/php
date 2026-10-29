<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WorkspaceOperationsSummaryRequest - Read a past [from,to) interval of at most 31 days. The complete retained populations must fit a combined 100000-row budget and a 1500ms SQL statement budget. No pagination or sampled totals; choose a shorter interval after a row-budget refusal. */
class WorkspaceOperationsSummaryRequest
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
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * @param  \NoResponse\Models\Shared\AuditSettingsEnvironment|string  $environment
     * @param  string  $from
     * @param  string  $to
     * @phpstan-pure
     */
    public function __construct(AuditSettingsEnvironment|string $environment, string $from, string $to)
    {
        $this->environment = $environment;
        $this->from = $from;
        $this->to = $to;
    }
}