<?php

declare(strict_types=1);

namespace NoResponse\Hooks;

use Psr\Http\Message\ResponseInterface;

interface AfterSuccessHook
{
    public function afterSuccess(AfterSuccessContext $context, ResponseInterface $response): ResponseInterface;
}
