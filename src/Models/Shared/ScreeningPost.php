<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningPost - One post a collector read, with its permalink and time. */
class ScreeningPost
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $text
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('text')]
    public string $text;

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
     * @var ?string $replyTo
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reply_to')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $replyTo = null;

    /**
     * The permalink of the post this one reposts. text then holds that post's author's words, not the person's.
     *
     * @var ?string $repostOf
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('repost_of')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $repostOf = null;

    /**
     * The permalink of the post this one quotes. text holds the person's own words alone.
     *
     * @var ?string $quoteOf
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('quote_of')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $quoteOf = null;

    /**
     * A place a post names, as the platform shows it.
     *
     * @var ?\NoResponse\Models\Shared\PostPlace $place
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('place')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PostPlace|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?PostPlace $place = null;

    /**
     * The handles of the accounts the post tags, on its own platform.
     *
     * @var ?array<string> $tagged
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('tagged')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $tagged = null;

    /**
     * How many likes the platform shows for the post.
     *
     * @var ?int $likes
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('likes')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $likes = null;

    /**
     * How many comments the platform shows for the post.
     *
     * @var ?int $comments
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('comments')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $comments = null;

    /**
     * How many views or plays the platform shows for the post.
     *
     * @var ?int $views
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('views')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $views = null;

    /**
     * How many times the platform shows the post was shared or reposted.
     *
     * @var ?int $shares
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('shares')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $shares = null;

    /**
     * The language the platform says the post is in, as the platform codes it, such as en or pt-BR.
     *
     * @var ?string $language
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('language')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $language = null;

    /**
     * true when the platform marks the post as edited after it went up. Absent when it does not mark it.
     *
     * @var ?bool $edited
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('edited')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $edited = null;

    /**
     * true when the platform marks the post as a paid partnership or an ad. Absent when it does not mark it.
     *
     * @var ?bool $sponsored
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sponsored')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $sponsored = null;

    /**
     * true when the platform labels the post as made or changed with AI. Absent when it does not label it.
     *
     * @var ?bool $aiGenerated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ai_generated')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $aiGenerated = null;

    /**
     * The app or device the platform says the post was made with.
     *
     * @var ?string $postedWith
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posted_with')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $postedWith = null;

    /**
     * Everything else the platform sent about the post, under the platform's own names and as it typed them: counts, ids of linked posts and accounts, links, media details, labels and notices. The fields above are not repeated here. Nothing that describes the account the screening read with, such as whether it liked or saved the post, is ever here.
     *
     * @var ?array<string, mixed> $stated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('stated')]
    #[\NoResponse\Serializer\Annotation\Type('array<string, mixed>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $stated = null;

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
     * @param  string  $text
     * @param  string  $profileId
     * @param  string  $permalink
     * @param  string  $postedAt
     * @param  ?string  $replyTo
     * @param  ?string  $repostOf
     * @param  ?string  $quoteOf
     * @param  ?\NoResponse\Models\Shared\PostPlace  $place
     * @param  ?array<string>  $tagged
     * @param  ?int  $likes
     * @param  ?int  $comments
     * @param  ?int  $views
     * @param  ?int  $shares
     * @param  ?string  $language
     * @param  ?bool  $edited
     * @param  ?bool  $sponsored
     * @param  ?bool  $aiGenerated
     * @param  ?string  $postedWith
     * @param  ?array<string, mixed>  $stated
     * @param  ?string  $screenshotSha256
     * @param  ?string  $capturedAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $text, string $profileId, string $permalink, string $postedAt, ?string $replyTo = null, ?string $repostOf = null, ?string $quoteOf = null, ?PostPlace $place = null, ?array $tagged = null, ?int $likes = null, ?int $comments = null, ?int $views = null, ?int $shares = null, ?string $language = null, ?bool $edited = null, ?bool $sponsored = null, ?bool $aiGenerated = null, ?string $postedWith = null, ?array $stated = null, ?string $screenshotSha256 = null, ?string $capturedAt = null, string $kind = 'post')
    {
        $this->id = $id;
        $this->text = $text;
        $this->profileId = $profileId;
        $this->permalink = $permalink;
        $this->postedAt = $postedAt;
        $this->replyTo = $replyTo;
        $this->repostOf = $repostOf;
        $this->quoteOf = $quoteOf;
        $this->place = $place;
        $this->tagged = $tagged;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->views = $views;
        $this->shares = $shares;
        $this->language = $language;
        $this->edited = $edited;
        $this->sponsored = $sponsored;
        $this->aiGenerated = $aiGenerated;
        $this->postedWith = $postedWith;
        $this->stated = $stated;
        $this->screenshotSha256 = $screenshotSha256;
        $this->capturedAt = $capturedAt;
        $this->kind = $kind;
    }
}