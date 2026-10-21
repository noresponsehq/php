<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class ConflictErrorThrowable extends \RuntimeException
{
    public ConflictError $container;

    public function __construct(string $message, int $statusCode, ConflictError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}