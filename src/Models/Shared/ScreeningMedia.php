<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningMedia - One image or video a collector read, with the post that carried it. */
class ScreeningMedia
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var \NoResponse\Models\Shared\MediaType|string $mediaType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media_type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\MediaType|string')]
    public MediaType|string $mediaType;

    /**
     * Where the platform serves the image or video.
     *
     * @var string $mediaUrl
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('media_url')]
    public string $mediaUrl;

    /**
     *
     * @var string $profileId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('profile_id')]
    public string $profileId;

    /**
     *
     * @var string $permalink
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('permalink')]
    public string $permalink;

    /**
     *
     * @var string $postedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posted_at')]
    public string $postedAt;

    /**
     *
     * @var ?string $postId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('post_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $postId = null;

    /**
     * The caption or alt text.
     *
     * @var ?string $text
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('text')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $text = null;

    /**
     * SHA-256 of the screenshot taken of a flagged item.
     *
     * @var ?string $screenshotSha256
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('screenshot_sha256')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $screenshotSha256 = null;

    /**
     * When the screenshot was taken.
     *
     * @var ?string $capturedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('captured_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $capturedAt = null;

    /**
     *
     * @var string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    public string $kind;

    /**
     * @param  string  $id
     * @param  string  $kind
     * @param  \NoResponse\Models\Shared\MediaType|string  $mediaType
     * @param  string  $mediaUrl
     * @param  string  $profileId
     * @param  string  $permalink
     * @param  string  $postedAt
     * @param  ?string  $postId
     * @param  ?string  $text
     * @param  ?string  $screenshotSha256
     * @param  ?string  $capturedAt
     * @phpstan-pure
     */
    public function __construct(string $id, MediaType|string $mediaType, string $mediaUrl, string $profileId, string $permalink, string $postedAt, ?string $postId = null, ?string $text = null, ?string $screenshotSha256 = null, ?string $capturedAt = null, string $kind = 'media')
    {
        $this->id = $id;
        $this->mediaType = $mediaType;
        $this->mediaUrl = $mediaUrl;
        $this->profileId = $profileId;
        $this->permalink = $permalink;
        $this->postedAt = $postedAt;
        $this->postId = $postId;
        $this->text = $text;
        $this->screenshotSha256 = $screenshotSha256;
        $this->capturedAt = $capturedAt;
        $this->kind = $kind;
    }
}