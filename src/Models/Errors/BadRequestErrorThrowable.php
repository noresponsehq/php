<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class BadRequestErrorThrowable extends \RuntimeException
{
    public BadRequestError $container;

    public function __construct(string $message, int $statusCode, BadRequestError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}