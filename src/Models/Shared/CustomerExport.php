<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** CustomerExport - Request an asynchronous customer export. */
class CustomerExport
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportRequestKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportRequestKind|string')]
    public CustomerExportRequestKind|string $kind;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Environment|string')]
    public Environment|string $environment;

    /**
     * standard returns the consolidated risk response; detailed adds merged provider-neutral facts when the key has detailed scope. There is no raw mode.
     *
     * @var \NoResponse\Models\Shared\ResponseMode|string $responseMode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('response_mode')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ResponseMode|string')]
    public ResponseMode|string $responseMode;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportStatus|string')]
    public CustomerExportStatus|string $status;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var int $records
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('records')]
    public int $records;

    /**
     *
     * @var int $bytes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bytes')]
    public int $bytes;

    /**
     *
     * @var int $chunks
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('chunks')]
    public int $chunks;

    /**
     *
     * @var int $attempts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('attempts')]
    public int $attempts;

    /**
     *
     * @var int $generation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('generation')]
    public int $generation;

    /**
     *
     * @var string $requestSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_sha256')]
    public string $requestSha256;

    /**
     *
     * @var ?string $snapshotAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('snapshot_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $snapshotAt = null;

    /**
     *
     * @var ?string $finishedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('finished_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $finishedAt = null;

    /**
     *
     * @var ?string $errorCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('error_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $errorCode = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\CustomerExportRequestKind|string  $kind
     * @param  \NoResponse\Models\Shared\Environment|string  $environment
     * @param  \NoResponse\Models\Shared\ResponseMode|string  $responseMode
     * @param  \NoResponse\Models\Shared\CustomerExportStatus|string  $status
     * @param  string  $createdAt
     * @param  string  $expiresAt
     * @param  int  $records
     * @param  int  $bytes
     * @param  int  $chunks
     * @param  int  $attempts
     * @param  int  $generation
     * @param  string  $requestSha256
     * @param  ?string  $snapshotAt
     * @param  ?string  $finishedAt
     * @param  ?string  $errorCode
     * @phpstan-pure
     */
    public function __construct(string $id, CustomerExportRequestKind|string $kind, Environment|string $environment, ResponseMode|string $responseMode, CustomerExportStatus|string $status, string $createdAt, string $expiresAt, int $records, int $bytes, int $chunks, int $attempts, int $generation, string $requestSha256, ?string $snapshotAt = null, ?string $finishedAt = null, ?string $errorCode = null)
    {
        $this->id = $id;
        $this->kind = $kind;
        $this->environment = $environment;
        $this->responseMode = $responseMode;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->expiresAt = $expiresAt;
        $this->records = $records;
        $this->bytes = $bytes;
        $this->chunks = $chunks;
        $this->attempts = $attempts;
        $this->generation = $generation;
        $this->requestSha256 = $requestSha256;
        $this->snapshotAt = $snapshotAt;
        $this->finishedAt = $finishedAt;
        $this->errorCode = $errorCode;
    }
}