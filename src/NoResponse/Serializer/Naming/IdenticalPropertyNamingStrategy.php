<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Naming;

use NoResponse\Serializer\Metadata\PropertyMetadata;

final class IdenticalPropertyNamingStrategy implements PropertyNamingStrategyInterface
{
    public function translateName(PropertyMetadata $property): string
    {
        return $property->name;
    }
}
