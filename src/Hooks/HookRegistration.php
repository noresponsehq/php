<?php

declare(strict_types=1);

namespace NoResponse\Hooks;

/*
 * Hand-written. Hooks are registered per SDK instance and last as long as it does.
 */
class HookRegistration
{
    /**
     * @param  Hooks  $hooks
     */
    public static function initHooks(Hooks $hooks): void
    {
        $hooks->registerBeforeRequestHook(new IdempotencyKeyHook());
    }
}
