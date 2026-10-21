<?php

declare(strict_types=1);

namespace NoResponse\Serializer\GraphNavigator\Factory;

use NoResponse\Serializer\GraphNavigatorInterface;

interface GraphNavigatorFactoryInterface
{
    public function getGraphNavigator(): GraphNavigatorInterface;
}
