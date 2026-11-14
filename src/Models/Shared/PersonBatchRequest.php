<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PersonBatchRequest - Adds or updates 1 to 500 people. A row naming an existing person of the group (the same external_id, else the same email, else the same phone) updates it. */
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