<?php

declare(strict_types=1);

namespace NoResponse;

use NoResponse\Utils\Retry;

/**
 * NoResponseClientBuilder is used to configure and build an instance of the SDK.
 */
class NoResponseClientBuilder
{
    public function __construct(
        private SDKConfiguration $sdkConfig = new SDKConfiguration(),
    ) {
    }

    /**
     * setClient allows setting a custom Guzzle client for the SDK to make requests with.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     * @return NoResponseClientBuilder
     */
    public function setClient(\GuzzleHttp\ClientInterface $client): NoResponseClientBuilder
    {
        $this->sdkConfig->client = $client;

        return $this;
    }

    /**
     * setSecurity is used to configure the security required for the SDK.
     *
     * @param  string  $apiKey
     * @return NoResponseClientBuilder
     */
    public function setSecurity(string $apiKey): NoResponseClientBuilder
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
     * @return NoResponseClientBuilder
     */
    public function setSecuritySource(\Closure $securitySource): NoResponseClientBuilder
    {
        $this->sdkConfig->securitySource = fn () => new Models\Shared\Security(apiKey: $securitySource());

        return $this;
    }

    /**
     * setServerUrl is used to configure the server URL for the SDK, and optionally template any parameters in the URL.
     *
     * @param  string  $serverUrl
     * @param  array<string, string>  $params
     * @return NoResponseClientBuilder
     */
    public function setServerUrl(string $serverUrl, ?array $params = null): NoResponseClientBuilder
    {
        $this->sdkConfig->serverUrl = Utils\Utils::templateUrl($serverUrl, $params);

        return $this;
    }

    /**
     * setServer is used to configure the server for the SDK
     *
     * @param  int  $serverIdx
     * @return NoResponseClientBuilder
     */
    public function setServerIndex(int $serverIdx): NoResponseClientBuilder
    {
        $this->sdkConfig->serverIndex = $serverIdx;

        return $this;
    }

    public function setRetryConfig(Retry\RetryConfig $config): NoResponseClientBuilder
    {
        $this->sdkConfig->retryConfig = $config;

        return $this;
    }

    /**
     * build is used to build the SDK with any of the configured options.
     *
     * @return NoResponseClient
     */
    public function build(): NoResponseClient
    {
        if ($this->sdkConfig->client === null) {
            $this->sdkConfig->client = new \GuzzleHttp\Client([
                'timeout' => 60,
            ]);
        }

        $this->sdkConfig->defaultClient = $this->sdkConfig->client;
        if (! $this->sdkConfig->hasSecurity()) {
            $envSecurity = getenv('NORESPONSE_API_KEY');
            if ($envSecurity !== false && $envSecurity !== '') {
                $this->setSecurity($envSecurity);
            }
        }
        if ($this->sdkConfig->hasSecurity()) {
            $this->sdkConfig->client = Utils\Utils::configureSecurityClient($this->sdkConfig->client, $this->sdkConfig->getSecurity());
        }

        return new NoResponseClient($this->sdkConfig);
    }
}