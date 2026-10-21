<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

class BadRequestException extends \NoResponse\Models\Errors\NoResponseException
{
    public BadRequestError $container;

    public function __construct(string $message, int $statusCode, BadRequestError $container)
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