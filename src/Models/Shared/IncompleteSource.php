<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** IncompleteSource - One evidence lane that did not settle, and why. It names a lane, not a source. A lane that missed its deadline is timed_out rather than not_found. */
class IncompleteSource
{
    /**
     * An evidence lane: accounts (account presence for email and username), phone, breach and ip.
     *
     * @var \NoResponse\Models\Shared\Lane $lane
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('lane')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Lane')]
    public Lane $lane;

    /**
     * Why a lane did not settle. deferred means the lane is asynchronous and still running; a continuation settles it. timed_out means the lane missed its deadline. insufficient_evidence is a settled inconclusive signal rather than an incomplete lane.
     *
     * @var \NoResponse\Models\Shared\IncompleteReason $reason
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('reason')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\IncompleteReason')]
    public IncompleteReason $reason;

    /**
     * @param  \NoResponse\Models\Shared\Lane  $lane
     * @param  \NoResponse\Models\Shared\IncompleteReason  $reason
     * @phpstan-pure
     */
    public function __construct(Lane $lane, IncompleteReason $reason)
    {
        $this->lane = $lane;
        $this->reason = $reason;
    }
}