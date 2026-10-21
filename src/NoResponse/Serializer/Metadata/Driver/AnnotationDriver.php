<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Metadata\Driver;

use Doctrine\Common\Annotations\Reader;
use NoResponse\Serializer\Expression\CompilableExpressionEvaluatorInterface;
use NoResponse\Serializer\Naming\PropertyNamingStrategyInterface;
use NoResponse\Serializer\Type\ParserInterface;

/**
 * @deprecated
 */
class AnnotationDriver extends AnnotationOrAttributeDriver
{
    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Reader $reader, PropertyNamingStrategyInterface $namingStrategy, ?ParserInterface $typeParser = null, ?CompilableExpressionEvaluatorInterface $expressionEvaluator = null)
    {
        parent::__construct($namingStrategy, $typeParser, $expressionEvaluator, $reader);

        $this->reader = $reader;
    }

    /**
     * @return list<object>
     */
    protected function getClassAnnotations(\ReflectionClass $class): array
    {
        return $this->reader->getClassAnnotations($class);
    }

    /**
     * @return list<object>
     */
    protected function getMethodAnnotations(\ReflectionMethod $method): array
    {
        return $this->reader->getMethodAnnotations($method);
    }

    /**
     * @return list<object>
     */
    protected function getPropertyAnnotations(\ReflectionProperty $property): array
    {
        return $this->reader->getPropertyAnnotations($property);
    }
}
