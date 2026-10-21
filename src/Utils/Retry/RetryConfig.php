<?php

declare(strict_types=1);

namespace NoResponse\Utils\Retry;

abstract class RetryConfig
{
    public RetryStrategy $strategy;
}
