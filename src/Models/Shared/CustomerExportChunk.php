<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** CustomerExportChunk - Download one authorized export chunk. */
class CustomerExportChunk
{
    /**
     *
     * @var string $exportId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('export_id')]
    public string $exportId;

    /**
     *
     * @var int $index
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('index')]
    public int $index;

    /**
     *
     * @var int $generation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('generation')]
    public int $generation;

    /**
     *
     * @var string $sha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sha256')]
    public string $sha256;

    /**
     * Base64-encoded UTF-8 JSON Lines, at most 256 KiB decoded. Each line is a typed customer export record. Decode and concatenate chunks in index order within the same generation.
     *
     * @var string $data
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('data')]
    public string $data;

    /**
     *
     * @var ?int $nextChunk
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('next_chunk')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $nextChunk = null;

    /**
     * @param  string  $exportId
     * @param  int  $index
     * @param  int  $generation
     * @param  string  $sha256
     * @param  string  $data
     * @param  ?int  $nextChunk
     * @phpstan-pure
     */
    public function __construct(string $exportId, int $index, int $generation, string $sha256, string $data, ?int $nextChunk = null)
    {
        $this->exportId = $exportId;
        $this->index = $index;
        $this->generation = $generation;
        $this->sha256 = $sha256;
        $this->data = $data;
        $this->nextChunk = $nextChunk;
    }
}