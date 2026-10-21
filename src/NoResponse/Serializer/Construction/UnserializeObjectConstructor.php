<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Construction;

use Doctrine\Instantiator\Instantiator;
use NoResponse\Serializer\DeserializationContext;
use NoResponse\Serializer\Metadata\ClassMetadata;
use NoResponse\Serializer\Visitor\DeserializationVisitorInterface;

final class UnserializeObjectConstructor implements ObjectConstructorInterface
{
    /** @var Instantiator */
    private $instantiator;

    /**
     * {@inheritdoc}
     */
    public function construct(DeserializationVisitorInterface $visitor, ClassMetadata $metadata, $data, array $type, DeserializationContext $context): ?object
    {
        return $this->getInstantiator()->instantiate($metadata->name);
    }

    private function getInstantiator(): Instantiator
    {
        if (null === $this->instantiator) {
            $this->instantiator = new Instantiator();
        }

        return $this->instantiator;
    }
}
