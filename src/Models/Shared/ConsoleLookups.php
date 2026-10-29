<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ConsoleLookups - The live environment's daily cap on assessments members make through the console (the playground), as spent on the current UTC day. Each console submission with a new Idempotency-Key spends one lookup; a replay spends nothing, and API keys and the test environment spend none. When used reaches limit, the next lookup answers 429 lookup_limit_reached until resets_at. The count is the one the cap enforces. */
class ConsoleLookups
{
    /**
     * Lookups spent since the last reset.
     *
     * @var int $used
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('used')]
    public int $used;

    /**
     * Lookups allowed per UTC day.
     *
     * @var int $limit
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('limit')]
    public int $limit;

    /**
     * The next reset: the coming midnight UTC, when used returns to 0.
     *
     * @var string $resetsAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('resets_at')]
    public string $resetsAt;

    /**
     * @param  int  $used
     * @param  int  $limit
     * @param  string  $resetsAt
     * @phpstan-pure
     */
    public function __construct(int $used, int $limit, string $resetsAt)
    {
        $this->used = $used;
        $this->limit = $limit;
        $this->resetsAt = $resetsAt;
    }
}