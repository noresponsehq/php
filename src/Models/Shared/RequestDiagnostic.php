<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RequestDiagnostic - One authenticated HTTP attempt. An attempt id is independent of the caller correlation id. No raw body, path parameter, credential or source payload is retained. write_complete means the server wrote/flushed its response, not proof the client processed it. Collection is bounded best effort; ii_signup_request_diagnostic_failures_total exposes gaps. Retained for seven days or the shorter environment retention. */
class RequestDiagnostic
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    public string $requestId;

    /**
     *
     * @var string $route
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('route')]
    public string $route;

    /**
     *
     * @var int $httpStatus
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('http_status')]
    public int $httpStatus;

    /**
     *
     * @var int $durationMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('duration_ms')]
    public int $durationMs;

    /**
     *
     * @var string $startedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('started_at')]
    public string $startedAt;

    /**
     *
     * @var string $completedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('completed_at')]
    public string $completedAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var bool $idempotentReplayed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('idempotent_replayed')]
    public bool $idempotentReplayed;

    /**
     *
     * @var bool $writeComplete
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('write_complete')]
    public bool $writeComplete;

    /**
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * The decision prepared for one HTTP attempt. Its account field preserves the account decision returned for that attempt, even after subsequent changes.
     *
     * @var ?\NoResponse\Models\Shared\DecisionReceipt $decision
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('decision')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\DecisionReceipt|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?DecisionReceipt $decision = null;

    /**
     * @param  string  $id
     * @param  string  $requestId
     * @param  string  $route
     * @param  int  $httpStatus
     * @param  int  $durationMs
     * @param  string  $startedAt
     * @param  string  $completedAt
     * @param  string  $expiresAt
     * @param  bool  $idempotentReplayed
     * @param  bool  $writeComplete
     * @param  ?string  $errorCode
     * @param  ?\NoResponse\Models\Shared\DecisionReceipt  $decision
     * @phpstan-pure
     */
    public function __construct(string $id, string $requestId, string $route, int $httpStatus, int $durationMs, string $startedAt, string $completedAt, string $expiresAt, bool $idempotentReplayed, bool $writeComplete, ?string $errorCode = null, ?DecisionReceipt $decision = null)
    {
        $this->id = $id;
        $this->requestId = $requestId;
        $this->route = $route;
        $this->httpStatus = $httpStatus;
        $this->durationMs = $durationMs;
        $this->startedAt = $startedAt;
        $this->completedAt = $completedAt;
        $this->expiresAt = $expiresAt;
        $this->idempotentReplayed = $idempotentReplayed;
        $this->writeComplete = $writeComplete;
        $this->errorCode = $errorCode;
        $this->decision = $decision;
    }
}