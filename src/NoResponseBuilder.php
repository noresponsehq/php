<?php

declare(strict_types=1);

namespace NoResponse;

use NoResponse\Utils\Retry;

/**
 * NoResponseBuilder is used to configure and build an instance of the SDK.
 */
class NoResponseBuilder
{
    public function __construct(
        private SDKConfiguration $sdkConfig = new SDKConfiguration(),
    ) {
    }

    /**
     * setClient allows setting a custom Guzzle client for the SDK to make requests with.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     * @return NoResponseBuilder
     */
    public function setClient(\GuzzleHttp\ClientInterface $client): NoResponseBuilder
    {
        $this->sdkConfig->client = $client;

        return $this;
    }

    /**
     * setSecurity is used to configure the security required for the SDK.
     *
     * @param  string  $apiKey
     * @return NoResponseBuilder
     */
    public function setSecurity(string $apiKey): NoResponseBuilder
    {
        $security = new Models\Shared\Security(
            apiKey: $apiKey
        );
        $this->sdkConfig->securitySource = fn () => $security;

        return $this;
    }

    /**
     * setSecuritySource is usd to configure the security required for the SDK.
     * unlike setSecurity, setSecuritySource accepts a closure that will be called to retrieve the security information.
     *
     * @param  pure-Closure(): string  $securitySource
     * @return NoResponseBuilder
     */
    public function setSecuritySource(\Closure $securitySource): NoResponseBuilder
    {
        $this->sdkConfig->securitySource = fn () => new Models\Shared\Security(apiKey: $securitySource());

        return $this;
    }

    /**
     * setServerUrl is used to configure the server URL for the SDK, and optionally template any parameters in the URL.
     *
     * @param  string  $serverUrl
     * @param  array<string, string>  $params
     * @return NoResponseBuilder
     */
    public function setServerUrl(string $serverUrl, ?array $params = null): NoResponseBuilder
    {
        $this->sdkConfig->serverUrl = Utils\Utils::templateUrl($serverUrl, $params);

        return $this;
    }

    /**
     * setServer is used to configure the server for the SDK
     *
     * @param  int  $serverIdx
     * @return NoResponseBuilder
     */
    public function setServerIndex(int $serverIdx): NoResponseBuilder
    {
        $this->sdkConfig->serverIndex = $serverIdx;

        return $this;
    }

    public function setRetryConfig(Retry\RetryConfig $config): NoResponseBuilder
    {
        $this->sdkConfig->retryConfig = $config;

        return $this;
    }

    /**
     * build is used to build the SDK with any of the configured options.
     *
     * @return NoResponse
     */
    public function build(): NoResponse
    {
        if ($this->sdkConfig->client === null) {
            $this->sdkConfig->client = new \GuzzleHttp\Client([
                'timeout' => 60,
            ]);
        }

        $this->sdkConfig->defaultClient = $this->sdkConfig->client;
        if ($this->sdkConfig->hasSecurity()) {
            $this->sdkConfig->client = Utils\Utils::configureSecurityClient($this->sdkConfig->client, $this->sdkConfig->getSecurity());
        }

        return new NoResponse($this->sdkConfig);
    }
}