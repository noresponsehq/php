<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** RequestAggregateRequest - Count every retained matching attempt in [from,to). Capture is best effort; missing attempts cannot be inferred. UTC buckets may be partial at the edges. The window is at most 7 days. */
class RequestAggregateRequest
{
    /**
     *
     * @var string $from
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('from')]
    public string $from;

    /**
     *
     * @var string $to
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('to')]
    public string $to;

    /**
     *
     * @var \NoResponse\Models\Shared\RequestAggregateRequestBucket|string|null $bucket
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bucket')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\RequestAggregateRequestBucket|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public RequestAggregateRequestBucket|string|null $bucket = null;

    /**
     *
     * @var ?int $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $status = null;

    /**
     *
     * @var ?string $route
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('route')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $route = null;

    /**
     *
     * @var ?string $apiKeyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('api_key_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $apiKeyId = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  \NoResponse\Models\Shared\RequestAggregateRequestBucket|string|null  $bucket
     * @param  ?int  $status
     * @param  ?string  $route
     * @param  ?string  $apiKeyId
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, RequestAggregateRequestBucket|string|null $bucket = null, ?int $status = null, ?string $route = null, ?string $apiKeyId = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->bucket = $bucket;
        $this->status = $status;
        $this->route = $route;
        $this->apiKeyId = $apiKeyId;
    }
}