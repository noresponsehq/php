<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class KeyActor
{
    /**
     * The public id of the workspace API key that made the change.
     *
     * @var string $keyId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('key_id')]
    public string $keyId;

    /**
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $type
     * @param  string  $keyId
     * @phpstan-pure
     */
    public function __construct(string $keyId, string $type = 'api_key')
    {
        $this->keyId = $keyId;
        $this->type = $type;
    }
}