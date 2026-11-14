<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningCompletedEvent - The screening.completed event. */
class ScreeningCompletedEvent
{
    /**
     * The event id, equal to the NR-Webhook-Id header and across redeliveries and every endpoint the event fans out to.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * When the event was created. Equal across redeliveries; the signing timestamp header is per delivery.
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * A screening of a group finished. It counts only the people this screening set out to reach, not who they are: read the roster with GET /v1/workspaces/{workspace_id}/groups/{environment}/{group_id}/people, filtered by band, to act on them. people_screened + partial_coverage = people_total, people_flagged is the sum of by_band, no_footprint counts screened people with no flag whose accounts were not found, and no_profile_to_check those the screening had nothing to look up for on any requested platform. A cancelled screening sends no event.
     *
     * @var \NoResponse\Models\Shared\ScreeningCompleted $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningCompleted')]
    public ScreeningCompleted $data;

    /**
     * Present, and true, only on an event sent by POST /v1/webhooks/{endpoint_id}/test: its data is a fixed example assessment, not one of the workspace's, so a receiver acknowledges it and applies nothing. Real events have no test member.
     *
     * @var ?bool $test
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('test')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $test = null;

    /**
     * Always screening.completed.
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  string  $type
     * @param  \NoResponse\Models\Shared\ScreeningCompleted  $data
     * @param  ?bool  $test
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, ScreeningCompleted $data, ?bool $test = null, string $type = 'screening.completed')
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->data = $data;
        $this->test = $test;
        $this->type = $type;
    }
}