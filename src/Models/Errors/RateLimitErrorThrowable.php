<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class RateLimitErrorThrowable extends \RuntimeException
{
    public RateLimitError $container;

    public function __construct(string $message, int $statusCode, RateLimitError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
}