<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Ordering;

use NoResponse\Serializer\Metadata\PropertyMetadata;

interface PropertyOrderingInterface
{
    /**
     * @param PropertyMetadata[] $properties name => property
     *
     * @return PropertyMetadata[] name => property
     */
    public function order(array $properties): array;
}
