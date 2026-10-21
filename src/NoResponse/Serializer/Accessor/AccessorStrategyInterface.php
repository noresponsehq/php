<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Accessor;

use NoResponse\Serializer\DeserializationContext;
use NoResponse\Serializer\Metadata\PropertyMetadata;
use NoResponse\Serializer\SerializationContext;

/**
 * @author Asmir Mustafic <goetas@gmail.com>
 */
interface AccessorStrategyInterface
{
    /**
     * @return mixed
     */
    public function getValue(object $object, PropertyMetadata $metadata, SerializationContext $context);

    /**
     * @param mixed $value
     */
    public function setValue(object $object, $value, PropertyMetadata $metadata, DeserializationContext $context): void;
}
