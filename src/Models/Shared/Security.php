<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;

use NoResponse\Utils\NoResponseMetadata;
class Security
{
    /**
     *
     * @var string $apiKey
     */
    #[NoResponseMetadata('security:scheme=true,type=http,subtype=bearer,name=Authorization')]
    public string $apiKey;

    /**
     * @param  string  $apiKey
     * @phpstan-pure
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }
}