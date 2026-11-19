<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ScreeningLookupAnswer
{
    /**
     * The id of the connector asked: breach for the breach search.
     *
     * @var string $connector
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('connector')]
    public string $connector;

    /**
     *
     * @var \NoResponse\Models\Shared\Identifier|string $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Identifier|string')]
    public Identifier|string $identifier;

    /**
     * Per-signal outcome. A source that timed out, was blocked or errored reports blocked, unavailable or inconclusive with a reason and is listed in incomplete_sources; not_found is a definite absence.
     *
     * @var \NoResponse\Models\Shared\SignalOutcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SignalOutcome|string')]
    public SignalOutcome|string $outcome;

    /**
     *
     * @var ?string $answeredAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('answered_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $answeredAt = null;

    /**
     * @param  string  $connector
     * @param  \NoResponse\Models\Shared\Identifier|string  $identifier
     * @param  \NoResponse\Models\Shared\SignalOutcome|string  $outcome
     * @param  ?string  $answeredAt
     * @phpstan-pure
     */
    public function __construct(string $connector, Identifier|string $identifier, SignalOutcome|string $outcome, ?string $answeredAt = null)
    {
        $this->connector = $connector;
        $this->identifier = $identifier;
        $this->outcome = $outcome;
        $this->answeredAt = $answeredAt;
    }
}