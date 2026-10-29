<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ReviewSubjectChange - The link and resulting review version. */
class ReviewSubjectChange
{
    /**
     *
     * @var int $reviewVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('review_version')]
    public int $reviewVersion;

    /**
     * A tenant-local investigation link. risk_version is the account risk version captured when the link was added. It does not assert a relationship or change feedback or enforcement.
     *
     * @var \NoResponse\Models\Shared\ReviewSubject $subject
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('subject')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewSubject')]
    public ReviewSubject $subject;

    /**
     * @param  int  $reviewVersion
     * @param  \NoResponse\Models\Shared\ReviewSubject  $subject
     * @phpstan-pure
     */
    public function __construct(int $reviewVersion, ReviewSubject $subject)
    {
        $this->reviewVersion = $reviewVersion;
        $this->subject = $subject;
    }
}