<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class NotFoundErrorThrowable extends \RuntimeException
{
    public NotFoundError $container;

    public function __construct(string $message, int $statusCode, NotFoundError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}