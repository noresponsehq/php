<?php

declare(strict_types=1);

namespace NoResponse;

use NoResponse\Hooks\HookContext;
use NoResponse\Models\Operations;
use NoResponse\Models\Shared;
use NoResponse\Serializer\DeserializationContext;
use NoResponse\Utils\Options;
use NoResponse\Utils\Retry;
use NoResponse\Utils\Retry\RetryUtils;

class Accounts
{
    private SDKConfiguration $sdkConfiguration;
    /**
     * @param  SDKConfiguration  $sdkConfig
     */
    public function __construct(public SDKConfiguration $sdkConfig)
    {
        $this->sdkConfiguration = $sdkConfig;
    }
    /**
     * @param  string  $baseUrl
     * @param  array<string, string>  $urlVariables
     *
     * @return string
     */
    public function getUrl(string $baseUrl, array $urlVariables): string
    {
        $serverDetails = $this->sdkConfiguration->getServerDetails();

        if ($baseUrl == null) {
            $baseUrl = $serverDetails->baseUrl;
        }

        if ($urlVariables == null) {
            $urlVariables = $serverDetails->options;
        }

        return Utils\Utils::templateUrl($baseUrl, $urlVariables);
    }

    /**
     * Associate a customer-issued API key
     *
     * Associate the SHA-256 of a high-entropy key issued by your service. Send the hash instead of the key. Repeating a hash returns its original association, including its retirement state. A hash associated with another account returns a conflict.
     *
     * @param  \NoResponse\Models\Shared\CredentialRequest  $body
     * @param  string  $accountId
     * @return \NoResponse\Models\Operations\AssociateCredentialResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function associateCredential(Shared\CredentialRequest $body, string $accountId, ?Options $options = null): Operations\AssociateCredentialResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\AssociateCredentialRequest(
            accountId: $accountId,
            body: $body,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/credentials', Operations\AssociateCredentialRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, 'body', 'json');
        if ($body === null) {
            throw new \Exception('Request body is required');
        }
        $httpOptions = array_merge_recursive($httpOptions, $body);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('POST', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'associateCredential', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200', '201'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\CredentialAssociation', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\AssociateCredentialResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Erase an account and its history.
     *
     * Erases the account in the environment of your key, for an erasure request from your user: every assessment of it, with its revisions, evidence and outcomes, and the identity-graph marks its outcomes set. An assessment of the account begun before the call is refused or stopped. Afterwards the account and each erased assessment answer 404 and the history is empty. When the call deleted at least one assessment, an account.deleted event goes to your verified webhook endpoints. Requires the history scope. Idempotent and safe to retry: a repeat, or an account with nothing to erase, answers 200 with assessments_deleted 0 and sends no event. The account_id can be assessed again later, as a new account.
     *
     * @param  string  $accountId
     * @return \NoResponse\Models\Operations\DeleteAccountResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function delete(string $accountId, ?Options $options = null): Operations\DeleteAccountResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\DeleteAccountRequest(
            accountId: $accountId,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}', Operations\DeleteAccountRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('DELETE', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'deleteAccount', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountDeletion', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\DeleteAccountResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Export an account
     *
     * Retrieve one consistent snapshot of retained customer-accessible records, including assessment revisions, account decisions, feedback, key associations, enforcements and request diagnostics. Each assessment revision's detail.identifiers holds the identifiers that assessment was sent, exactly as received. Secrets, restricted source information, other customers' data and legacy free-text notes are excluded. The same standard/detailed permissions apply. An export exceeding 10000 records or 8 MiB returns export_too_large without a partial result. Historical decisions that were not captured are identified as an exclusion.
     *
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @return \NoResponse\Models\Operations\ExportAccountResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function export(string $accountId, Shared\ResponseMode|string|null $responseMode = null, ?Options $options = null): Operations\ExportAccountResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ExportAccountRequest(
            accountId: $accountId,
            responseMode: $responseMode,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/export', Operations\ExportAccountRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ExportAccountRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'exportAccount', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountExport', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ExportAccountResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Read an account's one current risk.
     *
     * An account is the account_id you send with your assessments. Its current risk is the risk of its latest assessment with a decision (status complete or partial), scored as GET /v1/assessments/{assessment_id} scores that assessment, with a decision for each flow; risk.decision is the decision for the flow of that assessment. Every assessment answers with this same account. Every assessment updates its account: once an assessment completes, the account carries its risk. Requires the history scope. Read-only and safe to retry. An account with no unexpired assessment that has a decision answers 404 not_found, and a malformed account_id answers 400 invalid_request.
     *
     * @param  string  $accountId
     * @return \NoResponse\Models\Operations\GetAccountResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(string $accountId, ?Options $options = null): Operations\GetAccountResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\GetAccountRequest(
            accountId: $accountId,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}', Operations\GetAccountRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'getAccount', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\Account', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\GetAccountResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Retrieve an exact historical account decision
     *
     * Retrieve the account decision at one recorded risk version. The answer uses the original assessment and account-specific risk inputs. Earlier versions that were not captured return 404. The assessment version, policy version and account calculation version identify the decision.
     *
     * @param  string  $accountId
     * @param  int  $riskVersion
     * @return \NoResponse\Models\Operations\GetAccountDecisionResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retrieveDecision(string $accountId, int $riskVersion, ?Options $options = null): Operations\GetAccountDecisionResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\GetAccountDecisionRequest(
            accountId: $accountId,
            riskVersion: $riskVersion,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/decisions/{risk_version}', Operations\GetAccountDecisionRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'getAccountDecision', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountDecisionSnapshot', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\GetAccountDecisionResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Page through one account's unexpired assessments.
     *
     * The account's history: the same page as POST /v1/assessments/query for this account_id, newest first, each at its latest assessment_version. Requires the history scope. Read-only and safe to retry. An account with no assessments answers 200 with empty items. The cursor is opaque and bound to your workspace and the account; a tampered or expired cursor answers 400 invalid_cursor. response_mode=detailed needs the detailed scope. Each item's identifiers holds the identifiers its assessment was sent, exactly as received. The account_id travels in the URL; use POST /v1/assessments/query to keep it out of access logs.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @return \NoResponse\Models\Operations\ListAccountAssessmentsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listAssessmentsIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, Shared\ResponseMode|string|null $responseMode = null, ?Options $options = null): Operations\ListAccountAssessmentsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountAssessmentsRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
            responseMode: $responseMode,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/assessments', Operations\ListAccountAssessmentsRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountAssessmentsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccountAssessments', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AssessmentList', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountAssessmentsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListAccountAssessmentsResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listAssessmentsIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                        responseMode: $request != null ? $request->responseMode : null,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * Page through one account's unexpired assessments.
     *
     * The account's history: the same page as POST /v1/assessments/query for this account_id, newest first, each at its latest assessment_version. Requires the history scope. Read-only and safe to retry. An account with no assessments answers 200 with empty items. The cursor is opaque and bound to your workspace and the account; a tampered or expired cursor answers 400 invalid_cursor. response_mode=detailed needs the detailed scope. Each item's identifiers holds the identifiers its assessment was sent, exactly as received. The account_id travels in the URL; use POST /v1/assessments/query to keep it out of access logs.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @param  \NoResponse\Models\Shared\ResponseMode|string|null  $responseMode
     * @return \Generator<\NoResponse\Models\Operations\ListAccountAssessmentsResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listAssessments(string $accountId, ?int $limit = null, ?string $cursor = null, Shared\ResponseMode|string|null $responseMode = null, ?Options $options = null): \Generator
    {
        $res = $this->listAssessmentsIndividual($accountId, $limit, $cursor, $responseMode, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * List issued credential associations
     *
     * Retained credential associations, ordered by id. Page with the authenticated cursor. Associations are removed on account erasure.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \NoResponse\Models\Operations\ListAccountCredentialsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listCredentialsIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): Operations\ListAccountCredentialsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountCredentialsRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/credentials', Operations\ListAccountCredentialsRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountCredentialsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccountCredentials', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\CredentialPage', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountCredentialsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListAccountCredentialsResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listCredentialsIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * List issued credential associations
     *
     * Retained credential associations, ordered by id. Page with the authenticated cursor. Associations are removed on account erasure.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \Generator<\NoResponse\Models\Operations\ListAccountCredentialsResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listCredentials(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): \Generator
    {
        $res = $this->listCredentialsIndividual($accountId, $limit, $cursor, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * Page through recorded account decisions
     *
     * List retained immutable risk decisions for one account with an authenticated cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \NoResponse\Models\Operations\ListAccountDecisionsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listDecisionsIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): Operations\ListAccountDecisionsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountDecisionsRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/decisions', Operations\ListAccountDecisionsRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountDecisionsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccountDecisions', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountDecisionList', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountDecisionsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListAccountDecisionsResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listDecisionsIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * Page through recorded account decisions
     *
     * List retained immutable risk decisions for one account with an authenticated cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \Generator<\NoResponse\Models\Operations\ListAccountDecisionsResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listDecisions(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): \Generator
    {
        $res = $this->listDecisionsIndividual($accountId, $limit, $cursor, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * Page through account enforcements
     *
     * List retained enforcement reports for one account with an authenticated cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \NoResponse\Models\Operations\ListAccountEnforcementsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listEnforcementsIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): Operations\ListAccountEnforcementsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountEnforcementsRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/enforcements', Operations\ListAccountEnforcementsRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountEnforcementsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccountEnforcements', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountEnforcementList', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountEnforcementsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListAccountEnforcementsResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listEnforcementsIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * Page through account enforcements
     *
     * List retained enforcement reports for one account with an authenticated cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \Generator<\NoResponse\Models\Operations\ListAccountEnforcementsResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listEnforcements(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): \Generator
    {
        $res = $this->listEnforcementsIndividual($accountId, $limit, $cursor, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * List retained account feedback
     *
     * List retained account reports, newest first. The page-level effective outcome id names the current report. Each receipt preserves the effective report and risk version from its original write. Page with the returned cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \NoResponse\Models\Operations\ListAccountOutcomesResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listOutcomesIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): Operations\ListAccountOutcomesResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountOutcomesRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/outcomes', Operations\ListAccountOutcomesRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountOutcomesRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccountOutcomes', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountOutcomePage', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountOutcomesResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListAccountOutcomesResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listOutcomesIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * List retained account feedback
     *
     * List retained account reports, newest first. The page-level effective outcome id names the current report. Each receipt preserves the effective report and risk version from its original write. Page with the returned cursor.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \Generator<\NoResponse\Models\Operations\ListAccountOutcomesResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listOutcomes(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): \Generator
    {
        $res = $this->listOutcomesIndividual($accountId, $limit, $cursor, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * Poll the accounts whose risk changed.
     *
     * Your accounts whose risk changed, oldest change first, each as accounts.get answers it. Every page carries next_cursor: pass it back as changed_since to read the changes made after that page; without changed_since the list starts from the oldest change. When nothing changed, items is empty and next_cursor is the cursor you sent, so poll by calling again with the latest next_cursor. An account appears again each time its risk changes, with a higher risk_version; keep the copy with the highest. unenforced=true lists only accounts with a decision other than allow for some flow and no applied enforcement at their current risk_version; such a page can hold fewer than limit items, or none, while later changes exist, so keep polling with next_cursor. Requires the history scope. Read-only and safe to retry. A tampered or foreign cursor answers 400 invalid_cursor.
     *
     * @param  ?string  $changedSince
     * @param  ?int  $limit
     * @param  ?bool  $unenforced
     * @return \NoResponse\Models\Operations\ListAccountsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listChanged(?string $changedSince = null, ?int $limit = null, ?bool $unenforced = null, ?Options $options = null): Operations\ListAccountsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListAccountsRequest(
            changedSince: $changedSince,
            limit: $limit,
            unenforced: $unenforced,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts');
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListAccountsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listAccounts', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountList', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListAccountsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * List accounts that share a submitted identifier with this account.
     *
     * Lists the other accounts in this environment whose retained assessments submitted an email, phone or customer-namespace username that one of this account's retained assessments also submitted. Matching uses the identifier search rules: exact, canonical and, for email, mailbox. Each linked account names one entry per shared kind, at the strictest basis that links the two accounts, with the original value, assessment_id and submitted_at of each account's newest retained submission of it. Only customer-submitted identifiers link accounts; source-discovered identifiers do not. Expired, deleted and erased assessments link nothing. The account itself is not listed, and an account with no retained submissions answers 200 with empty items. A shared identifier is not verified ownership. Totals are exact below 10000 and capped at 10000. The cursor is opaque, expiring and bound to your workspace, environment and the account; a tampered or expired cursor answers 400 invalid_cursor. Requires the history scope, or investigate with evidence. Read-only and safe to retry.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \NoResponse\Models\Operations\ListLinkedAccountsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function listLinkedIndividual(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): Operations\ListLinkedAccountsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\ListLinkedAccountsRequest(
            accountId: $accountId,
            limit: $limit,
            cursor: $cursor,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/linked_accounts', Operations\ListLinkedAccountsRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];

        $qp = Utils\Utils::getQueryParams(Operations\ListLinkedAccountsRequest::class, $request, $urlOverride);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('GET', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'listLinkedAccounts', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions['query'] = Utils\QueryParameters::standardizeQueryParams($httpRequest, $qp);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\LinkedAccountPage', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\ListLinkedAccountsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );
                $sdk = $this;

                $response->next = function () use ($sdk, $responseData, $request): ?Operations\ListLinkedAccountsResponse {
                    $jsonObject = new \JsonPath\JsonObject($responseData);
                    $nextCursor = $jsonObject->get('$.next_cursor');
                    if ($nextCursor == null) {
                        return null;
                    } else {
                        $nextCursor = $nextCursor[0];
                        if ($nextCursor == null || (is_string($nextCursor) && trim($nextCursor) === '')) {
                            return null;
                        }
                    }

                    return $sdk->listLinkedIndividual(
                        accountId: $request != null ? $request->accountId : '',
                        limit: $request != null ? $request->limit : null,
                        cursor: $nextCursor,
                    );
                };


                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }
    /**
     * List accounts that share a submitted identifier with this account.
     *
     * Lists the other accounts in this environment whose retained assessments submitted an email, phone or customer-namespace username that one of this account's retained assessments also submitted. Matching uses the identifier search rules: exact, canonical and, for email, mailbox. Each linked account names one entry per shared kind, at the strictest basis that links the two accounts, with the original value, assessment_id and submitted_at of each account's newest retained submission of it. Only customer-submitted identifiers link accounts; source-discovered identifiers do not. Expired, deleted and erased assessments link nothing. The account itself is not listed, and an account with no retained submissions answers 200 with empty items. A shared identifier is not verified ownership. Totals are exact below 10000 and capped at 10000. The cursor is opaque, expiring and bound to your workspace, environment and the account; a tampered or expired cursor answers 400 invalid_cursor. Requires the history scope, or investigate with evidence. Read-only and safe to retry.
     *
     * @param  string  $accountId
     * @param  ?int  $limit
     * @param  ?string  $cursor
     * @return \Generator<\NoResponse\Models\Operations\ListLinkedAccountsResponse>
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function listLinked(string $accountId, ?int $limit = null, ?string $cursor = null, ?Options $options = null): \Generator
    {
        $res = $this->listLinkedIndividual($accountId, $limit, $cursor, $options);
        while ($res !== null) {
            yield $res;
            $res = $res->next($res);
        }
    }

    /**
     * Record or correct an account outcome
     *
     * Record a factual report, not an enforcement action. A known outcome replaces the effective report. unknown alone records uncertainty without changing it; unknown with supersedes explicitly retracts it. supersedes must name the current effective report or the request answers 409 outcome_conflict. Reports remain append-only. Idempotency-Key is required. observed_at defaults to receipt time and cannot be over five minutes ahead.
     *
     * @param  \NoResponse\Models\Shared\AccountOutcomeRequest  $body
     * @param  string  $accountId
     * @param  ?string  $idempotencyKey
     * @return \NoResponse\Models\Operations\RecordAccountOutcomeResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recordOutcome(Shared\AccountOutcomeRequest $body, string $accountId, ?string $idempotencyKey = null, ?Options $options = null): Operations\RecordAccountOutcomeResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\RecordAccountOutcomeRequest(
            accountId: $accountId,
            body: $body,
            idempotencyKey: $idempotencyKey,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/outcomes', Operations\RecordAccountOutcomeRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, 'body', 'json');
        if ($body === null) {
            throw new \Exception('Request body is required');
        }
        $httpOptions = array_merge_recursive($httpOptions, $body);
        $httpOptions = array_merge_recursive($httpOptions, Utils\Utils::getHeaders($request));
        if (! array_key_exists('headers', $httpOptions)) {
            $httpOptions['headers'] = [];
        }
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('POST', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'recordAccountOutcome', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['202'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountOutcome', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\RecordAccountOutcomeResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Record what you did to an account in your identity provider.
     *
     * Records what you did to the account in your identity provider for one flow's decision at one risk_version: the action (or none), the account's state before it, the provider and whether it was applied or failed. It is your action, not an outcome, and it leaves the account's risk unchanged. A record is kept once per account, risk_version, flow and action: the first report answers 201, and a repeat answers 200 with the stored record unchanged, so retries are safe without an Idempotency-Key. An applied report after a failed one replaces the failed record, keeping its id and created_at, and answers 201. A risk_version older than the account's current one is accepted and stored, but only an applied record at the current risk_version takes the account out of listChanged with unenforced=true; a newer one answers 409 risk_version_ahead. An account with no current risk answers 404 not_found. error_code is allowed only with status failed. Requires the history scope.
     *
     * @param  \NoResponse\Models\Shared\EnforcementRequest  $body
     * @param  string  $accountId
     * @return \NoResponse\Models\Operations\RecordEnforcementResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function recordEnforcement(Shared\EnforcementRequest $body, string $accountId, ?Options $options = null): Operations\RecordEnforcementResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\RecordEnforcementRequest(
            accountId: $accountId,
            body: $body,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/enforcements', Operations\RecordEnforcementRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, 'body', 'json');
        if ($body === null) {
            throw new \Exception('Request body is required');
        }
        $httpOptions = array_merge_recursive($httpOptions, $body);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('POST', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'recordEnforcement', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200', '201'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\Enforcement', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\RecordEnforcementResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Retire an issued credential association
     *
     * Mark this association retired, idempotently. This does not revoke the actual key. Requires delete scope.
     *
     * @param  string  $accountId
     * @param  string  $credentialId
     * @return \NoResponse\Models\Operations\RetireAccountCredentialResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function retireCredential(string $accountId, string $credentialId, ?Options $options = null): Operations\RetireAccountCredentialResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $request = new Operations\RetireAccountCredentialRequest(
            accountId: $accountId,
            credentialId: $credentialId,
        );
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/{account_id}/credentials/{credential_id}', Operations\RetireAccountCredentialRequest::class, $request);
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('DELETE', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'retireAccountCredential', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\CredentialAssociation', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\RetireAccountCredentialResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

    /**
     * Search distinct accounts by submitted identifier or account ID
     *
     * Search distinct accounts observed in retained assessments in this environment. identifier matches an exact, canonical or explicitly selected mailbox form of a submitted email, phone or customer-namespace username. It matches historical retained inputs and returns matched_identifier with the original value and matching assessment. Each row has its newest retained assessment, current account decision when available, retained assessment count, and total distinct-account count. identifier and legacy email are mutually exclusive; account_id and needs_action combine with either using AND. Set needs_action to select accounts with a retained open or in-progress review, or a current review/block account decision without an effective retained account outcome. This filter applies before counting and pagination and adds waiting_for reasons. Current decisions include account list overrides and shared-key scoring and preserve admission holds. Typed identifier search uses stable opaque account order; ordinary and legacy email searches retain newest-seen order. Results are live across pages; each page's items and total share a database snapshot, while current account risk is read separately. Cursors are expiring and bound to scope, operation and filters. Totals are exact below 10000 and capped at 10000. Requires history or investigate authority and identifier-read permission for identifier, identifier_expression or email filtering. needs_action additionally requires management scope. Source-discovered associations are not searched and equality is not verified ownership. identifier_expression combines submitted terms with bounded AND/OR, at most 8 raw terms and 3 group levels. Each node selects exactly one of term, and, or. Groups have 2 to 8 operands. Duplicate normalized terms are idempotent and still count toward the limit. identifier_expression, identifier and email are mutually exclusive. Expression results use matched_identifiers with original submitted witnesses and zero-based depth-first term_index. All satisfied unique terms are returned in first-occurrence order. Cursors bind scope, ordered structure, original values, matching modes and all other filters; changing only page limit is allowed. Required expression scope assessment evaluates the whole expression in one retained submission; scope account allows different retained submissions of the same account to satisfy different terms. Both use stable opaque account ordering and distinct-account counting before pagination.
     *
     * @param  \NoResponse\Models\Shared\AccountDirectorySearchRequest  $request
     * @return \NoResponse\Models\Operations\SearchAccountsResponse
     * @throws \NoResponse\Models\Errors\BadRequestException
     * @throws \NoResponse\Models\Errors\AuthenticationException
     * @throws \NoResponse\Models\Errors\PermissionDeniedException
     * @throws \NoResponse\Models\Errors\NotFoundException
     * @throws \NoResponse\Models\Errors\ConflictException
     * @throws \NoResponse\Models\Errors\RateLimitException
     * @throws \NoResponse\Models\Errors\APIStatusException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function search(Shared\AccountDirectorySearchRequest $request, ?Options $options = null): Operations\SearchAccountsResponse
    {
        $retryConfig = null;
        if ($options) {
            $retryConfig = $options->retryConfig;
        }
        if ($retryConfig === null && $this->sdkConfiguration->retryConfig) {
            $retryConfig = $this->sdkConfiguration->retryConfig;
        }
        if ($retryConfig === null) {
            $retryConfig = new Retry\RetryConfigBackoff(
                initialIntervalMs: 500,
                maxIntervalMs: 8000,
                exponent: 2,
                maxElapsedTimeMs: 30000,
                retryConnectionErrors: true,
            );
        }
        $retryCodes = null;
        if ($options) {
            $retryCodes = $options->retryCodes;
        }
        if ($retryCodes === null) {
            $retryCodes = [
                '408',
                '429',
                '5XX',
            ];
        }
        $baseUrl = $this->sdkConfiguration->getTemplatedServerUrl();
        $url = Utils\Utils::generateUrl($baseUrl, '/v1/accounts/search');
        $urlOverride = null;
        $httpOptions = ['http_errors' => false];
        $body = Utils\Utils::serializeRequestBody($request, 'request', 'json');
        if ($body === null) {
            throw new \Exception('Request body is required');
        }
        $httpOptions = array_merge_recursive($httpOptions, $body);
        $httpOptions['headers']['Accept'] = 'application/json';
        $httpOptions['headers']['user-agent'] = $this->sdkConfiguration->userAgent;
        $httpRequest = new \GuzzleHttp\Psr7\Request('POST', $url, $httpOptions['headers']);
        $hookContext = new HookContext($this->sdkConfiguration, $baseUrl, 'searchAccounts', null, $this->sdkConfiguration->securitySource);
        $httpRequest = $this->sdkConfiguration->hooks->beforeRequest(new Hooks\BeforeRequestContext($hookContext), $httpRequest);
        $httpOptions = Utils\Utils::convertHeadersToOptions($httpRequest, $httpOptions);
        $httpRequest = Utils\Utils::removeHeaders($httpRequest);
        try {
            $httpResponse = RetryUtils::retryWrapper(fn () => $this->sdkConfiguration->client->send($httpRequest, $httpOptions), $retryConfig, $retryCodes);
        } catch (\GuzzleHttp\Exception\GuzzleException $error) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), null, $error);
            $httpResponse = $res;
        }
        $contentType = $httpResponse->getHeader('Content-Type')[0] ?? '';

        if (Utils\Utils::matchStatusCodes($httpResponse->getStatusCode(), ['4XX', '5XX'])) {
            $res = $this->sdkConfiguration->hooks->afterError(new Hooks\AfterErrorContext($hookContext), $httpResponse, null);
            $httpResponse = $res;
        }

        $statusCode = $httpResponse->getStatusCode();
        if (Utils\Utils::matchStatusCodes($statusCode, ['200'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Shared\AccountDirectoryPage', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                $result = $obj;
                $response = new Operations\SearchAccountsResponse(
                    result: $result,
                    headers: $httpResponse->getHeaders()
                );

                return $response;
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['400'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\BadRequestError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['401'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\AuthenticationError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['403'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\PermissionDeniedError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['404'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\NotFoundError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['409'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\ConflictError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['429'])) {
            if (Utils\Utils::matchContentType($contentType, 'application/problem+json')) {
                $httpResponse = $this->sdkConfiguration->hooks->afterSuccess(new Hooks\AfterSuccessContext($hookContext), $httpResponse);

                $serializer = Utils\JSON::createSerializer();
                $responseData = (string) $httpResponse->getBody();
                $obj = $serializer->deserialize($responseData, '\NoResponse\Models\Errors\RateLimitError', 'json', DeserializationContext::create()->setRequireAllRequiredProperties(true));
                throw $obj->toException();
            } else {
                throw new \NoResponse\Models\Errors\APIStatusException('Unknown content type received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
            }
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['4XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } elseif (Utils\Utils::matchStatusCodes($statusCode, ['5XX'])) {
            throw new \NoResponse\Models\Errors\APIStatusException('API error occurred', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        } else {
            throw new \NoResponse\Models\Errors\APIStatusException('Unknown status code received', $statusCode, $httpResponse->getBody()->getContents(), $httpResponse);
        }
    }

}