<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RecordDistinctive - How distinctive a searchable value is: an email, phone, username, password, hash, person name or IP. Absent for other values, for a field with no value, and when its rating could not be worked out, such as when a count failed. Linkage weighs a password, hash or username by these numbers: the rarer the value, the more a shared one counts. */
class RecordDistinctive
{
    /**
     * unique: an email or phone, which belongs to one person by design. distinctive: rare enough that a new search on it likely finds one person. common: shared by many people, so a search on it finds strangers. A new search is suggested for unique and distinctive values only; any value can still be searched.
     *
     * @var \NoResponse\Models\Shared\Rating|string $rating
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rating')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Rating|string')]
    public Rating|string $rating;

    /**
     * Why, in plain words, such as "seen 3,861,493 times in breach data", "in 4 breach rows" or "38 bits, about one in 430 billion usernames".
     *
     * @var string $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    public string $reason;

    /**
     * How many breach rows hold the value, when they were counted. Set for a username, password, hash or person name.
     *
     * @var ?int $rows
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rows')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $rows = null;

    /**
     * How many times the Pwned Passwords list holds the password, when it was asked. Set for a password only.
     *
     * @var ?int $pwned
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('pwned')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $pwned = null;

    /**
     * How surprising the username is, to one decimal place: a character model spells it about once in 2^bits usernames. Set for a username the model can spell.
     *
     * @var ?float $bits
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bits')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $bits = null;

    /**
     * @param  \NoResponse\Models\Shared\Rating|string  $rating
     * @param  string  $reason
     * @param  ?int  $rows
     * @param  ?int  $pwned
     * @param  ?float  $bits
     * @phpstan-pure
     */
    public function __construct(Rating|string $rating, string $reason, ?int $rows = null, ?int $pwned = null, ?float $bits = null)
    {
        $this->rating = $rating;
        $this->reason = $reason;
        $this->rows = $rows;
        $this->pwned = $pwned;
        $this->bits = $bits;
    }
}