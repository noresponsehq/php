<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PersonMatch
{
    /**
     *
     * @var string $personId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person_id')]
    public string $personId;

    /**
     * $matchedOn
     *
     * @var array<\NoResponse\Models\Shared\PersonMatchMatchedOn|string> $matchedOn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_on')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonMatchMatchedOn|string>')]
    public array $matchedOn;

    /**
     * @param  string  $personId
     * @param  array<\NoResponse\Models\Shared\PersonMatchMatchedOn|string>  $matchedOn
     * @phpstan-pure
     */
    public function __construct(string $personId, array $matchedOn)
    {
        $this->personId = $personId;
        $this->matchedOn = $matchedOn;
    }
}