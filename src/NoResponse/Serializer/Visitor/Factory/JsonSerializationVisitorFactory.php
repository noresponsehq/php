<?php

declare(strict_types=1);

namespace NoResponse\Serializer\Visitor\Factory;

use NoResponse\Serializer\JsonSerializationVisitor;
use NoResponse\Serializer\Visitor\SerializationVisitorInterface;

/**
 * @author Asmir Mustafic <goetas@gmail.com>
 */
final class JsonSerializationVisitorFactory implements SerializationVisitorFactory
{
    /**
     * @var int
     */
    private $options = JSON_PRESERVE_ZERO_FRACTION;

    public function getVisitor(): SerializationVisitorInterface
    {
        return new JsonSerializationVisitor($this->options);
    }

    public function setOptions(int $options): self
    {
        $this->options = $options;

        return $this;
    }
}
