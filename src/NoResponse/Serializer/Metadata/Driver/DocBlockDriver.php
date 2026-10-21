<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Metadata\Driver;

use NoResponse\Serializer\Metadata\ClassMetadata as SerializerClassMetadata;
use NoResponse\Serializer\Metadata\Driver\DocBlockDriver\DocBlockTypeResolver;
use NoResponse\Serializer\Metadata\ExpressionPropertyMetadata;
use NoResponse\Serializer\Metadata\PropertyMetadata;
use NoResponse\Serializer\Metadata\StaticPropertyMetadata;
use NoResponse\Serializer\Metadata\VirtualPropertyMetadata;
use NoResponse\Serializer\Type\Parser;
use NoResponse\Serializer\Type\ParserInterface;
use Metadata\ClassMetadata;
use Metadata\Driver\DriverInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionProperty;

class DocBlockDriver implements DriverInterface
{
    /**
     * @var DriverInterface
     */
    protected $delegate;

    /**
     * @var ParserInterface
     */
    protected $typeParser;
    /**
     * @var DocBlockTypeResolver
     */
    private $docBlockTypeResolver;

    public function __construct(DriverInterface $delegate, ?ParserInterface $typeParser = null)
    {
        $this->delegate = $delegate;
        $this->typeParser = $typeParser ?: new Parser();
        $this->docBlockTypeResolver = new DocBlockTypeResolver();
    }

    /**
     * @return SerializerClassMetadata|null
     */
    public function loadMetadataForClass(ReflectionClass $class): ?ClassMetadata
    {
        $classMetadata = $this->delegate->loadMetadataForClass($class);

        if (null === $classMetadata) {
            return null;
        }

        \assert($classMetadata instanceof SerializerClassMetadata);

        // We base our scan on the internal driver's property list so that we
        // respect any internal allow/blocklist like in the AnnotationDriver
        foreach ($classMetadata->propertyMetadata as $key => $propertyMetadata) {
            // If the inner driver provides a type, don't guess anymore.
            if ($propertyMetadata->type) {
                continue;
            }

            if ($this->isNotSupportedVirtualProperty($propertyMetadata)) {
                continue;
            }

            try {
                if ($propertyMetadata instanceof VirtualPropertyMetadata) {
                    $type = $this->docBlockTypeResolver->getMethodDocblockTypeHint(
                        new ReflectionMethod($propertyMetadata->class, $propertyMetadata->getter),
                    );
                } else {
                    $type = $this->docBlockTypeResolver->getPropertyDocblockTypeHint(
                        new ReflectionProperty($propertyMetadata->class, $propertyMetadata->name),
                    );
                }

                if ($type) {
                    $propertyMetadata->setType($this->typeParser->parse($type));
                }
            } catch (ReflectionException $e) {
                continue;
            }
        }

        return $classMetadata;
    }

    private function isNotSupportedVirtualProperty(PropertyMetadata $propertyMetadata): bool
    {
        return $propertyMetadata instanceof StaticPropertyMetadata
            || $propertyMetadata instanceof ExpressionPropertyMetadata;
    }
}
