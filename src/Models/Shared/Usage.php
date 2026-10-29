<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Usage - Body of the 200 answer to GET /v1/workspaces/{workspace_id}/usage: what the workspace's environments were metered for on each UTC day from from through to. Each billable unit is counted once, where it becomes final: an assessment when it is admitted (by flow and depth), a webhook delivery once per event per endpoint (retries and replays add nothing), and a key-usage event once when the ingest accepts it. A count does not change when the assessment, account or workspace is later deleted. A day, environment or metric with nothing counted has no item. No prices or billing. console_lookups is the one limit: the live environment's daily cap on console lookups, as spent today. */
class Usage
{
    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     * The first UTC day covered.
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     * The last UTC day covered, included.
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     * Ordered by environment (live first), then day, metric, flow and depth.
     *
     * @var array<\NoResponse\Models\Shared\UsageCount> $items
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\UsageCount>')]
    public array $items;

    /**
     * The live environment's daily cap on assessments members make through the console (the playground), as spent on the current UTC day. Each console submission with a new Idempotency-Key spends one lookup; a replay spends nothing, and API keys and the test environment spend none. When used reaches limit, the next lookup answers 429 lookup_limit_reached until resets_at. The count is the one the cap enforces.
     *
     * @var ?\NoResponse\Models\Shared\ConsoleLookups $consoleLookups
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('console_lookups')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ConsoleLookups|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ConsoleLookups $consoleLookups = null;

    /**
     * @param  string  $workspaceId
     * @param  string  $from
     * @param  string  $to
     * @param  array<\NoResponse\Models\Shared\UsageCount>  $items
     * @param  ?\NoResponse\Models\Shared\ConsoleLookups  $consoleLookups
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $from, string $to, array $items, ?ConsoleLookups $consoleLookups = null)
    {
        $this->workspaceId = $workspaceId;
        $this->from = $from;
        $this->to = $to;
        $this->items = $items;
        $this->consoleLookups = $consoleLookups;
    }
}