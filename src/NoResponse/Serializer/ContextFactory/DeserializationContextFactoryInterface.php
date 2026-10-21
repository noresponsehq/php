<?php

declare(strict_types=1);

namespace NoResponse\Serializer\ContextFactory;

use NoResponse\Serializer\DeserializationContext;

/**
 * Deserialization Context Factory Interface.
 */
interface DeserializationContextFactoryInterface
{
    public function createDeserializationContext(): DeserializationContext;
}
