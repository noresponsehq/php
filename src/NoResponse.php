<?php

declare(strict_types=1);

namespace NoResponse;



/**
 * NoResponse - NoResponse API: Server-side signup and gateway risk assessment: a recommendation, polling and signed webhooks.
 *
 * Assess a signup or gateway event, poll a pending assessment, page through an account's history, record what you later learned, and rotate your API key. Every response carries X-Request-ID; every error is an RFC 9457 problem document. Keep the API key on your server.
 */
class NoResponse
{
    public const SERVERS = [
        /** Production */
        'https://api.noresponse.org',
    ];

    /**
     * Signup and gateway assessments.
     *
     * @var Assessments $$assessments
     */
    public Assessments $assessments;

    /**
     * Your own API keys.
     *
     * @var Keys $$keys
     */
    public Keys $keys;

    /**
     * Returns a new instance of the SDK builder used to configure and create the SDK instance.
     *
     * @return NoResponseBuilder
     */
    public static function builder(): NoResponseBuilder
    {
        return new NoResponseBuilder();
    }

    /**
     * @param  SDKConfiguration  $sdkConfiguration
     */
    public function __construct(
        public SDKConfiguration $sdkConfiguration,
    ) {
        $this->assessments = new Assessments($this->sdkConfiguration);
        $this->keys = new Keys($this->sdkConfiguration);
        $this->initHooks();

    }

    private function initHooks(): void
    {
        $this->sdkConfiguration = $this->sdkConfiguration->hooks->sdkInit($this->sdkConfiguration);
    }
}