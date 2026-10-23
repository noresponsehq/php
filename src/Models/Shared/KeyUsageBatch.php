<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** KeyUsageBatch - The 202 answer of POST /v1/key_usage/batches. A replay with the same Idempotency-Key and body answers the same record and counts nothing again. */
class KeyUsageBatch
{
    /**
     * Opaque, server-assigned id of the batch: 'kub_' and a 26-character Crockford base32 ULID.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * When NoResponse first recorded the batch.
     *
     * @var string $receivedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('received_at')]
    public string $receivedAt;

    /**
     * Events counted.
     *
     * @var int $accepted
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('accepted')]
    public int $accepted;

    /**
     * Events that added nothing: a private, reserved or unreadable ip, or an occurred_at more than 24 hours old or more than 5 minutes ahead.
     *
     * @var int $ignored
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ignored')]
    public int $ignored;

    /**
     * @param  string  $id
     * @param  string  $receivedAt
     * @param  int  $accepted
     * @param  int  $ignored
     * @phpstan-pure
     */
    public function __construct(string $id, string $receivedAt, int $accepted, int $ignored)
    {
        $this->id = $id;
        $this->receivedAt = $receivedAt;
        $this->accepted = $accepted;
        $this->ignored = $ignored;
    }
}