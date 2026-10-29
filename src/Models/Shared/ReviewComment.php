<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewComment
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var int $reviewVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_version')]
    public int $reviewVersion;

    /**
     *
     * @var string $body
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('body')]
    public string $body;

    /**
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * @param  string  $id
     * @param  int  $reviewVersion
     * @param  string  $body
     * @param  string  $createdBy
     * @param  string  $createdAt
     * @phpstan-pure
     */
    public function __construct(string $id, int $reviewVersion, string $body, string $createdBy, string $createdAt)
    {
        $this->id = $id;
        $this->reviewVersion = $reviewVersion;
        $this->body = $body;
        $this->createdBy = $createdBy;
        $this->createdAt = $createdAt;
    }
}