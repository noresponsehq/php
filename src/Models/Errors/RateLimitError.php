<?php

declare(strict_types=1);

namespace NoResponse\Models\Errors;

use NoResponse\Models\Shared;
use NoResponse\Utils;
/** RateLimitError - HTTP 429 problem document. */
class RateLimitError
{
    /**
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     *
     * @var string $title
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('title')]
    public string $title;

    /**
     *
     * @var int $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    public int $status;

    /**
     *
     * @var string $detail
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('detail')]
    public string $detail;

    /**
     *
     * @var ?string $instance
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('instance')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $instance = null;

    /**
     * Machine codes an HTTP 429 answer can carry.
     *
     * @var \NoResponse\Models\Shared\RateLimitErrorCode $code
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('code')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RateLimitErrorCode')]
    public Shared\RateLimitErrorCode $code;

    /**
     *
     * @var string $requestId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('request_id')]
    public string $requestId;

    /**
     * $invalidParams
     *
     * @var ?array<\NoResponse\Models\Shared\ProblemInvalidParam> $invalidParams
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('invalid_params')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ProblemInvalidParam>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $invalidParams = null;

    /**
     * @param  string  $type
     * @param  string  $title
     * @param  int  $status
     * @param  string  $detail
     * @param  \NoResponse\Models\Shared\RateLimitErrorCode  $code
     * @param  string  $requestId
     * @param  ?string  $instance
     * @param  ?array<\NoResponse\Models\Shared\ProblemInvalidParam>  $invalidParams
     * @phpstan-pure
     */
    public function __construct(string $type, string $title, string $detail, Shared\RateLimitErrorCode $code, string $requestId, ?string $instance = null, ?array $invalidParams = null, int $status = 429)
    {
        $this->type = $type;
        $this->title = $title;
        $this->status = $status;
        $this->detail = $detail;
        $this->instance = $instance;
        $this->code = $code;
        $this->requestId = $requestId;
        $this->invalidParams = $invalidParams;
    }

    public function toException(): RateLimitException
    {
        $serializer = Utils\JSON::createSerializer();
        $message = $serializer->serialize($this, 'json');
        $code = $this->status;

        return new RateLimitException($message, (int) $code, $this);
    }
}