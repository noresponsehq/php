<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonBatchRequest - Adds 1 to 500 workspace people to the group. Reuses an explicit person_id or external_id. Matching email or phone values only suggest people; automatic merging is disabled. */
class PersonBatchRequest
{
    /**
     * $people
     *
     * @var array<\NoResponse\Models\Shared\PersonIdentity> $people
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('people')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonIdentity>')]
    public array $people;

    /**
     * @param  array<\NoResponse\Models\Shared\PersonIdentity>  $people
     * @phpstan-pure
     */
    public function __construct(array $people)
    {
        $this->people = $people;
    }
}