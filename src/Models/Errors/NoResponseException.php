<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

/**
 * Every exception the SDK throws for an API response extends this class, so one
 * catch block handles them all.
 */
class NoResponseException extends \RuntimeException
{
}
