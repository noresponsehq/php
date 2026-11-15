<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ScreeningLookupCheckUnansweredItem
{
    /**
     * The id of the connector that did not answer: breach for the breach search.
     *
     * @var string $connector
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('connector')]
    public string $connector;

    /**
     * Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it.
     *
     * @var \NoResponse\Models\Shared\FailureReason|string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FailureReason|string')]
    public FailureReason|string $reason;

    /**
     * @param  string  $connector
     * @param  \NoResponse\Models\Shared\FailureReason|string  $reason
     * @phpstan-pure
     */
    public function __construct(string $connector, FailureReason|string $reason)
    {
        $this->connector = $connector;
        $this->reason = $reason;
    }
}