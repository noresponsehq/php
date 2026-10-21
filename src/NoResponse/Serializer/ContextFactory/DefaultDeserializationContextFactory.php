<?php

declare(strict_types=1);

namespace NoResponse\Serializer\ContextFactory;

use NoResponse\Serializer\DeserializationContext;

/**
 * Default Deserialization Context Factory.
 */
final class DefaultDeserializationContextFactory implements DeserializationContextFactoryInterface
{
    public function createDeserializationContext(): DeserializationContext
    {
        return new DeserializationContext();
    }
}
