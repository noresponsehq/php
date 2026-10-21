<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class AuthenticationErrorThrowable extends \RuntimeException
{
    public AuthenticationError $container;

    public function __construct(string $message, int $statusCode, AuthenticationError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}