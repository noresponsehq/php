<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** PostPlace - A place a post names, as the platform shows it. */
class PostPlace
{
    /**
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * The platform's own id of the place.
     *
     * @var ?string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $id = null;

    /**
     *
     * @var ?string $address
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('address')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $address = null;

    /**
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     *
     * @var ?float $latitude
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('latitude')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $latitude = null;

    /**
     *
     * @var ?float $longitude
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('longitude')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $longitude = null;

    /**
     * @param  string  $name
     * @param  ?string  $id
     * @param  ?string  $address
     * @param  ?string  $city
     * @param  ?float  $latitude
     * @param  ?float  $longitude
     * @phpstan-pure
     */
    public function __construct(string $name, ?string $id = null, ?string $address = null, ?string $city = null, ?float $latitude = null, ?float $longitude = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->address = $address;
        $this->city = $city;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}