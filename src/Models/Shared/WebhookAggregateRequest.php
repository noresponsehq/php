<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WebhookAggregateRequest - Count every retained matching attempt in [from,to). Capture is best effort; missing attempts cannot be inferred. UTC buckets may be partial at the edges. The window is at most 30 days. */
class WebhookAggregateRequest
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
     * Opaque id of the endpoint registration.
     *
     * @var ?string $endpointId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('endpoint_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $endpointId = null;

    /**
     * @param  string  $from
     * @param  string  $to
     * @param  \NoResponse\Models\Shared\RequestAggregateRequestBucket|string|null  $bucket
     * @param  ?int  $status
     * @param  ?string  $endpointId
     * @phpstan-pure
     */
    public function __construct(string $from, string $to, RequestAggregateRequestBucket|string|null $bucket = null, ?int $status = null, ?string $endpointId = null)
    {
        $this->from = $from;
        $this->to = $to;
        $this->bucket = $bucket;
        $this->status = $status;
        $this->endpointId = $endpointId;
    }
}