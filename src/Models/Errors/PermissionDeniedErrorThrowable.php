<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class PermissionDeniedErrorThrowable extends \RuntimeException
{
    public PermissionDeniedError $container;

    public function __construct(string $message, int $statusCode, PermissionDeniedError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}