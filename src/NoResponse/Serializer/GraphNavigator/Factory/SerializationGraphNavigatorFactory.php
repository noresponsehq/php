<?php

declare(strict_types=1);

namespace NoResponse\Serializer\GraphNavigator\Factory;

use NoResponse\Serializer\Accessor\AccessorStrategyInterface;
use NoResponse\Serializer\Accessor\DefaultAccessorStrategy;
use NoResponse\Serializer\EventDispatcher\EventDispatcher;
use NoResponse\Serializer\EventDispatcher\EventDispatcherInterface;
use NoResponse\Serializer\Expression\ExpressionEvaluatorInterface;
use NoResponse\Serializer\GraphNavigator\SerializationGraphNavigator;
use NoResponse\Serializer\GraphNavigatorInterface;
use NoResponse\Serializer\Handler\HandlerRegistryInterface;
use Metadata\MetadataFactoryInterface;

final class SerializationGraphNavigatorFactory implements GraphNavigatorFactoryInterface
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
        ?AccessorStrategyInterface $accessor = null,
        ?EventDispatcherInterface $dispatcher = null,
        ?ExpressionEvaluatorInterface $expressionEvaluator = null
    ) {
        $this->metadataFactory = $metadataFactory;
        $this->handlerRegistry = $handlerRegistry;
        $this->accessor = $accessor ?: new DefaultAccessorStrategy();
        $this->dispatcher = $dispatcher ?: new EventDispatcher();
        $this->expressionEvaluator = $expressionEvaluator;
    }

    public function getGraphNavigator(): GraphNavigatorInterface
    {
        return new SerializationGraphNavigator($this->metadataFactory, $this->handlerRegistry, $this->accessor, $this->dispatcher, $this->expressionEvaluator);
    }
}
