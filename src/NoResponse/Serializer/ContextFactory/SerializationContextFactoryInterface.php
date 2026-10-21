<?php

declare(strict_types=1);

namespace NoResponse\Serializer\ContextFactory;

use NoResponse\Serializer\SerializationContext;

/**
 * Serialization Context Factory Interface.
 */
interface SerializationContextFactoryInterface
{
    public function createSerializationContext(): SerializationContext;
}
