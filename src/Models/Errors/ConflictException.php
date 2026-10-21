<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class ConflictException extends \NoResponse\Models\Errors\NoResponseException
{
    public ConflictError $container;

    public function __construct(string $message, int $statusCode, ConflictError $container)
    {
        parent::__construct($message, $statusCode);
        $this->container = $container;
    }
    public function getStatusCode(): int
    {
        return $this->container->status;
    }
    public function getRequestId(): string
    {
        return $this->container->requestId;
    }
}