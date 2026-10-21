<?php

declare(strict_types=1);

namespace NoResponse\Hooks;

use NoResponse\SDKConfiguration;

interface SDKInitHook
{
    public function sdkInit(SDKConfiguration $config): SDKConfiguration;
}
