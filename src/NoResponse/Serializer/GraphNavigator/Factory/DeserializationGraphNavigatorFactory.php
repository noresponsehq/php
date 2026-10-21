<?php

declare(strict_types=1);

namespace NoResponse\Serializer\GraphNavigator\Factory;

use NoResponse\Serializer\Accessor\AccessorStrategyInterface;
use NoResponse\Serializer\Construction\ObjectConstructorInterface;
use NoResponse\Serializer\EventDispatcher\EventDispatcherInterface;
use NoResponse\Serializer\Expression\ExpressionEvaluatorInterface;
use NoResponse\Serializer\GraphNavigator\DeserializationGraphNavigator;
use NoResponse\Serializer\GraphNavigatorInterface;
use NoResponse\Serializer\Handler\HandlerRegistryInterface;
use Metadata\MetadataFactoryInterface;

final class DeserializationGraphNavigatorFactory implements GraphNavigatorFactoryInterface
{
    /**
     * @var MetadataFactoryInterface
     */
    private $metadataFactory;
    /**
     * @var HandlerRegistryInterface
     */
    private $handlerRegistry;
    /**
     * @var ObjectConstructorInterface
     */
    private $objectConstructor;
    /**
     * @var AccessorStrategyInterface
     */
    private $accessor;
    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;
    /**
     * @var ExpressionEvaluatorInterface
     */
    private $expressionEvaluator;

    public function __construct(
        MetadataFactoryInterface $metadataFactory,
        HandlerRegistryInterface $handlerRegistry,
        ObjectConstructorInterface $objectConstructor,
        AccessorStrategyInterface $accessor,
        ?EventDispatcherInterface $dispatcher = null,
        ?ExpressionEvaluatorInterface $expressionEvaluator = null
    ) {
        $this->metadataFactory = $metadataFactory;
        $this->handlerRegistry = $handlerRegistry;
        $this->objectConstructor = $objectConstructor;
        $this->accessor = $accessor;
        $this->dispatcher = $dispatcher;
        $this->expressionEvaluator = $expressionEvaluator;
    }

    public function getGraphNavigator(): GraphNavigatorInterface
    {
        return new DeserializationGraphNavigator($this->metadataFactory, $this->handlerRegistry, $this->objectConstructor, $this->accessor, $this->dispatcher, $this->expressionEvaluator);
    }
}
