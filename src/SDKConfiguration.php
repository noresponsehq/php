<?php

declare(strict_types=1);

namespace NoResponse;
use NoResponse\Utils\Retry\RetryConfig;

class SDKConfiguration
{
    public ?\GuzzleHttp\ClientInterface $client = null;

    public ?\GuzzleHttp\ClientInterface $defaultClient = null;

    public Hooks\SDKHooks $hooks;
    /** @var ?pure-Closure(): Models\Shared\Security */
    public ?\Closure $securitySource = null;
    public string $serverUrl = '';

    public int $serverIndex = 0;

    public string $language = 'php';

    public string $openapiDocVersion = '1';

    public string $sdkVersion = '8.0.1';

    public string $genVersion = 'internal';

    public string $userAgent = 'noresponse-sdk/php 8.0.1 internal 1 noresponse/noresponse-php';

    public ?RetryConfig $retryConfig = null;

    public function __construct()
    {
        $this->hooks = new Hooks\SDKHooks();
    }

    public function getServerUrl(): string
    {

        if ($this->serverUrl !== '') {
            return $this->serverUrl;
        }

        if (isset(NoResponseClient::SERVERS[$this->serverIndex])) {
            return NoResponseClient::SERVERS[$this->serverIndex];
        } else {
            throw new \OutOfBoundsException('Server index '.$this->serverIndex.' is out of bounds');
        }
    }
    public function hasSecurity(): bool
    {
        return $this->securitySource !== null;
    }

    public function getSecurity(): ?Models\Shared\Security
    {
        return $this->securitySource->call($this);
    }

    /**
     * @return Utils\ServerDetails
     */
    public function getServerDetails(): Utils\ServerDetails
    {
        if ($this->serverUrl !== '') {
            return new Utils\ServerDetails(rtrim($this->serverUrl, '/'), []);
        }
        if ($this->serverIndex === null) {
            $this->serverIndex = 0;
        }

        return new Utils\ServerDetails(NoResponseClient::SERVERS[$this->serverIndex], []);

    }

    public function getTemplatedServerUrl(): string
    {
        if ($this->serverUrl) {
            return Utils\Utils::templateUrl($this->serverUrl.trim('/'), []);
        }

        return Utils\Utils::templateUrl($this->getServerUrl(), []);
    }
}
