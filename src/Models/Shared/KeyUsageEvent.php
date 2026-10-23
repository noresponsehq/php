<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyUsageEvent - One request made with an issued key. An event whose ip is not a public address, or whose occurred_at is more than 24 hours old or more than 5 minutes ahead, is counted in ignored and adds nothing. */
class KeyUsageEvent
{
    /**
     * SHA-256 of the issued key's UTF-8 bytes, as 64 lower-case hex characters: the value sent as issued_credential.sha256 when the account was assessed. Each SDK's issued-credential helper computes it.
     *
     * @var string $keySha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_sha256')]
    public string $keySha256;

    /**
     * The client IP address the request came from, IPv4 or IPv6, as your server saw it. Stored only as a keyed digest and its country.
     *
     * @var string $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    public string $ip;

    /**
     * When the request was made.
     *
     * @var string $occurredAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('occurred_at')]
    public string $occurredAt;

    /**
     * The request's User-Agent header, at most 512 characters. Stored only as a keyed digest.
     *
     * @var ?string $userAgent
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('user_agent')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $userAgent = null;

    /**
     * The model or product the request used, such as gpt-4o-mini. Stored only as a keyed digest.
     *
     * @var ?string $model
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('model')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $model = null;

    /**
     * Input tokens the request consumed.
     *
     * @var ?int $inputTokens
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('input_tokens')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $inputTokens = null;

    /**
     * Output tokens the request produced.
     *
     * @var ?int $outputTokens
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('output_tokens')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $outputTokens = null;

    /**
     * The share of requests your sampler records, when it records only some: 0.1 means this event stands for 10 requests. Request and token totals are weighted by its inverse. Distinct IP and country counts see only the events sent.
     *
     * @var ?float $sampleRate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sample_rate')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?float $sampleRate = null;

    /**
     * @param  string  $keySha256
     * @param  string  $ip
     * @param  string  $occurredAt
     * @param  ?string  $userAgent
     * @param  ?string  $model
     * @param  ?int  $inputTokens
     * @param  ?int  $outputTokens
     * @param  ?float  $sampleRate
     * @phpstan-pure
     */
    public function __construct(string $keySha256, string $ip, string $occurredAt, ?string $userAgent = null, ?string $model = null, ?int $inputTokens = null, ?int $outputTokens = null, ?float $sampleRate = 1)
    {
        $this->keySha256 = $keySha256;
        $this->ip = $ip;
        $this->occurredAt = $occurredAt;
        $this->userAgent = $userAgent;
        $this->model = $model;
        $this->inputTokens = $inputTokens;
        $this->outputTokens = $outputTokens;
        $this->sampleRate = $sampleRate;
    }
}