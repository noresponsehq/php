<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Visitor\Factory;

use NoResponse\Serializer\Visitor\SerializationVisitorInterface;

/**
 * @author Asmir Mustafic <goetas@gmail.com>
 */
interface SerializationVisitorFactory
{
    public function getVisitor(): SerializationVisitorInterface;
}
