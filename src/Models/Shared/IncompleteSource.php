<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IncompleteSource - One evidence lane that did not settle, and why. It names a lane, not a source. A lane that missed its deadline is timed_out rather than not_found. */
class IncompleteSource
{
    /**
     * An evidence lane: accounts (account presence for email and username), phone, breach, domain (the email domain's registration) and ip.
     *
     * @var \NoResponse\Models\Shared\Lane|string $lane
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('lane')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Lane|string')]
    public Lane|string $lane;

    /**
     * Why a lane did not settle. deferred means the lane is asynchronous and still running; a continuation settles it. timed_out means the lane missed its deadline. insufficient_evidence is a settled inconclusive signal rather than an incomplete lane.
     *
     * @var \NoResponse\Models\Shared\IncompleteReason|string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\IncompleteReason|string')]
    public IncompleteReason|string $reason;

    /**
     * @param  \NoResponse\Models\Shared\Lane|string  $lane
     * @param  \NoResponse\Models\Shared\IncompleteReason|string  $reason
     * @phpstan-pure
     */
    public function __construct(Lane|string $lane, IncompleteReason|string $reason)
    {
        $this->lane = $lane;
        $this->reason = $reason;
    }
}