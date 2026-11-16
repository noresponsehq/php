<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ProfileCitation
{
    /**
     * record: a record in lookup.records or profiles[].record. post: an item in posts. check: an item in lookup.checks.
     *
     * @var \NoResponse\Models\Shared\ProfileCitationKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ProfileCitationKind|string')]
    public ProfileCitationKind|string $kind;

    /**
     * The record or post id. For a check, c followed by its 1-based position in lookup.checks.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * @param  \NoResponse\Models\Shared\ProfileCitationKind|string  $kind
     * @param  string  $id
     * @phpstan-pure
     */
    public function __construct(ProfileCitationKind|string $kind, string $id)
    {
        $this->kind = $kind;
        $this->id = $id;
    }
}