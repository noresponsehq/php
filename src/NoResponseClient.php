<?php

declare(strict_types=1);

namespace NoResponse;



/**
 * NoResponseClient - NoResponse API: Server-side risk assessment of account creation, login and purchase: a recommendation, polling and signed webhooks.
 *
 * Assess an account creation, login or purchase and get back the account's one current risk, poll a pending assessment, page through an account's history, record what you later learned, report usage of the API keys you issue to your accounts, rotate your API key, manage your webhook endpoints, and register hosted endpoints that answer your WorkOS, Auth0 or Supabase sign-up and sign-in hooks. Every response carries X-Request-ID; every error is an RFC 9457 problem document. Keep the API key on your server.
 */
class NoResponseClient
{
    public const SERVERS = [
        /** Production */
        'https://api.noresponse.org',
    ];

    /**
     * Assessments of account creation, login and purchase.
     *
     * @var Assessments $$assessments
     */
    public Assessments $assessments;

    /**
     * Your accounts, each with one current risk, and their assessment history.
     *
     * @var Accounts $$accounts
     */
    public Accounts $accounts;

    public KeyUsage $keyUsage;

    /**
     * Your own API keys.
     *
     * @var Keys $$keys
     */
    public Keys $keys;

    /**
     * Hosted endpoints that answer your sign-up and sign-in hooks.
     *
     * @var Integrations $$integrations
     */
    public Integrations $integrations;

    /**
     * Your webhook endpoints: register, list, rotate signing keys, send test events and delete.
     *
     * @var WebhookEndpoints $$webhookEndpoints
     */
    public WebhookEndpoints $webhookEndpoints;

    public Settings $settings;

    public Lists $lists;

    /**
     * Returns a new instance of the SDK builder used to configure and create the SDK instance.
     *
     * @return NoResponseClientBuilder
     */
    public static function builder(): NoResponseClientBuilder
    {
        return new NoResponseClientBuilder();
    }
    /**
     * Returns an SDK instance that authenticates with the given API key and uses the default server.
     *
     * @param  string  $apiKey
     * @return NoResponseClient
     */
    public static function create(string $apiKey): NoResponseClient
    {
        return self::builder()->setSecurity($apiKey)->build();
    }

    /**
     * @param  SDKConfiguration  $sdkConfiguration
     */
    public function __construct(
        public SDKConfiguration $sdkConfiguration,
    ) {
        $this->assessments = new Assessments($this->sdkConfiguration);
        $this->accounts = new Accounts($this->sdkConfiguration);
        $this->keyUsage = new KeyUsage($this->sdkConfiguration);
        $this->keys = new Keys($this->sdkConfiguration);
        $this->integrations = new Integrations($this->sdkConfiguration);
        $this->webhookEndpoints = new WebhookEndpoints($this->sdkConfiguration);
        $this->settings = new Settings($this->sdkConfiguration);
        $this->lists = new Lists($this->sdkConfiguration);
        $this->initHooks();

    }

    private function initHooks(): void
    {
        $this->sdkConfiguration = $this->sdkConfiguration->hooks->sdkInit($this->sdkConfiguration);
    }
}