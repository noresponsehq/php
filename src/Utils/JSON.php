<?php

declare(strict_types=1);

namespace NoResponse\Utils;


use NoResponse\Serializer\Handler\ArrayCollectionHandler;
use NoResponse\Serializer\Handler\HandlerRegistry;
use NoResponse\Serializer\Handler\IteratorHandler;
use NoResponse\Serializer\Handler\StdClassHandler;
use NoResponse\Serializer\SerializationContext;
use NoResponse\Serializer\SerializerBuilder;
use NoResponse\Serializer\Visitor\Factory\JsonDeserializationVisitorFactory;


class JSON
{
    public static function createSerializer(): \NoResponse\Serializer\Serializer
    {
        return SerializerBuilder::create()->configureHandlers(
            static function (HandlerRegistry $registry): void {
                $registry->registerSubscribingHandler(new StdClassHandler());
                $registry->registerSubscribingHandler(new ArrayCollectionHandler());
                $registry->registerSubscribingHandler(new IteratorHandler());
                $registry->registerSubscribingHandler(new MixedJSONHandler());
                $registry->registerSubscribingHandler(new EnumHandler());
                $registry->registerSubscribingHandler(new DateTimeHandler());
                $registry->registerSubscribingHandler(new DateHandler());
                $registry->registerSubscribingHandler(new UnionHandler());
                $registry->registerSubscribingHandler(new BigIntHandler());
                $registry->registerSubscribingHandler(new BigDecimalHandler());
            },
        )->setDeserializationVisitor('json', (new JsonDeserializationVisitorFactory())->setOptions(JSON_BIGINT_AS_STRING)
        )->setTypeParser(new PhpDocTypeParser()
        )->setSerializationContextFactory(function () {
            return SerializationContext::create()
                ->setSerializeNull(true);
        })->build();
    }
}
