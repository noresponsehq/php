<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningProfile - An account the screening matched to the person, how it was matched, and how much of it was read. */
class ScreeningProfile
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * A platform a screening can cover. synthetic is the deterministic connector's own platform, for exercising the product end to end with no network.
     *
     * @var \NoResponse\Models\Shared\HandlePlatform|string $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\HandlePlatform|string')]
    public HandlePlatform|string $platform;

    /**
     *
     * @var string $handle
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('handle')]
    public string $handle;

    /**
     *
     * @var string $url
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('url')]
    public string $url;

    /**
     * public profiles were read; a private or locked one exists but could not be read.
     *
     * @var \NoResponse\Models\Shared\Access|string $access
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('access')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Access|string')]
    public Access|string $access;

    /**
     * How a profile was matched to the person: the state its evidence earns, and the evidence.
     *
     * @var \NoResponse\Models\Shared\ScreeningMatch $match
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('match')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningMatch')]
    public ScreeningMatch $match;

    /**
     * The resolver, collector or analyser that produced a record, by its catalogue name.
     *
     * @var string $collector
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('collector')]
    public string $collector;

    /**
     *
     * @var int $itemsRead
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('items_read')]
    public int $itemsRead;

    /**
     *
     * @var string $collectedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('collected_at')]
    public string $collectedAt;

    /**
     *
     * @var ?string $displayName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('display_name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $displayName = null;

    /**
     *
     * @var ?string $bio
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('bio')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $bio = null;

    /**
     *
     * @var ?string $avatarUrl
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('avatar_url')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $avatarUrl = null;

    /**
     *
     * @var ?int $followers
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('followers')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $followers = null;

    /**
     *
     * @var ?string $accountCreatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_created_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $accountCreatedAt = null;

    /**
     * Why fewer posts were read than the screening's depth asks for while the account holds more. platform_limit: the platform shows the screening no more of them. page_limit: the pages a screening reads ran out first. rate_limited or unavailable: a later page was held back or failed; the posts before it are kept and the person is partial. Absent when the account was read to its end or to the depth.
     *
     * @var \NoResponse\Models\Shared\PostsStopped|string|null $postsStopped
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('posts_stopped')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\PostsStopped|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public PostsStopped|string|null $postsStopped = null;

    /**
     * The oldest item read.
     *
     * @var ?string $periodFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('period_from')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $periodFrom = null;

    /**
     * The newest item read.
     *
     * @var ?string $periodTo
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('period_to')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $periodTo = null;

    /**
     * One answer from one source: where it came from, what found it and every field it holds.
     *
     * @var ?\NoResponse\Models\Shared\Record $record
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('record')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Record|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Record $record = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\HandlePlatform|string  $platform
     * @param  string  $handle
     * @param  string  $url
     * @param  \NoResponse\Models\Shared\Access|string  $access
     * @param  \NoResponse\Models\Shared\ScreeningMatch  $match
     * @param  string  $collector
     * @param  int  $itemsRead
     * @param  string  $collectedAt
     * @param  ?string  $displayName
     * @param  ?string  $bio
     * @param  ?string  $avatarUrl
     * @param  ?int  $followers
     * @param  ?string  $accountCreatedAt
     * @param  \NoResponse\Models\Shared\PostsStopped|string|null  $postsStopped
     * @param  ?string  $periodFrom
     * @param  ?string  $periodTo
     * @param  ?\NoResponse\Models\Shared\Record  $record
     * @phpstan-pure
     */
    public function __construct(string $id, HandlePlatform|string $platform, string $handle, string $url, Access|string $access, ScreeningMatch $match, string $collector, int $itemsRead, string $collectedAt, ?string $displayName = null, ?string $bio = null, ?string $avatarUrl = null, ?int $followers = null, ?string $accountCreatedAt = null, PostsStopped|string|null $postsStopped = null, ?string $periodFrom = null, ?string $periodTo = null, ?Record $record = null)
    {
        $this->id = $id;
        $this->platform = $platform;
        $this->handle = $handle;
        $this->url = $url;
        $this->access = $access;
        $this->match = $match;
        $this->collector = $collector;
        $this->itemsRead = $itemsRead;
        $this->collectedAt = $collectedAt;
        $this->displayName = $displayName;
        $this->bio = $bio;
        $this->avatarUrl = $avatarUrl;
        $this->followers = $followers;
        $this->accountCreatedAt = $accountCreatedAt;
        $this->postsStopped = $postsStopped;
        $this->periodFrom = $periodFrom;
        $this->periodTo = $periodTo;
        $this->record = $record;
    }
}