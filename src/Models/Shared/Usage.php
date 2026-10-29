<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Usage - Body of the 200 answer to GET /v1/workspaces/{workspace_id}/usage: what the workspace's environments were metered for on each UTC day from from through to. Each billable unit is counted once, where it becomes final: an assessment when it is admitted (by flow and depth), a webhook delivery once per event per endpoint (retries and replays add nothing), and a key-usage event once when the ingest accepts it. A count does not change when the assessment, account or workspace is later deleted. A day, environment or metric with nothing counted has no item. No prices, limits or billing. */
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
     * @param  string  $workspaceId
     * @param  string  $from
     * @param  string  $to
     * @param  array<\NoResponse\Models\Shared\UsageCount>  $items
     * @phpstan-pure
     */
    public function __construct(string $workspaceId, string $from, string $to, array $items)
    {
        $this->workspaceId = $workspaceId;
        $this->from = $from;
        $this->to = $to;
        $this->items = $items;
    }
}