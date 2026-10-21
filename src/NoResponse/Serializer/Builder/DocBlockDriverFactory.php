<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Builder;

use Doctrine\Common\Annotations\Reader;
use NoResponse\Serializer\Metadata\Driver\DocBlockDriver;
use NoResponse\Serializer\Type\ParserInterface;
use Metadata\Driver\DriverInterface;

class DocBlockDriverFactory implements DriverFactoryInterface
{
    /**
     * @var DriverFactoryInterface
     */
    private $driverFactoryToDecorate;
    /**
     * @var ParserInterface|null
     */
    private $typeParser;

    public function __construct(DriverFactoryInterface $driverFactoryToDecorate, ?ParserInterface $typeParser = null)
    {
        $this->driverFactoryToDecorate = $driverFactoryToDecorate;
        $this->typeParser = $typeParser;
    }

    public function createDriver(array $metadataDirs, ?Reader $annotationReader = null): DriverInterface
    {
        $driver = $this->driverFactoryToDecorate->createDriver($metadataDirs, $annotationReader);

        return new DocBlockDriver($driver, $this->typeParser);
    }
}
