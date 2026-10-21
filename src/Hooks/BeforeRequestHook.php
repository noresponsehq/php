<?php

declare(strict_types=1);

namespace NoResponse\Hooks;

use Psr\Http\Message\RequestInterface;

interface BeforeRequestHook
{
    public function beforeRequest(BeforeRequestContext $context, RequestInterface $request): RequestInterface;
}
