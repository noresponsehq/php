<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListPreviewRequest - Choose an addition or a removal. The preview performs no list, account, audit, outcome or outbox write. */
class ListPreviewRequest
{
    /**
     * POST /v1/workspaces/{workspace_id}/lists/{environment} body. Adds one entry to the environment's list and, in the same change, re-decides every account it matches: each sends account.risk_changed when a decision changes. Needs the admin or owner role, or a management key of the environment.
     *
     * @var ?\NoResponse\Models\Shared\ListEntryRequest $add
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('add')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListEntryRequest|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?ListEntryRequest $add = null;

    /**
     *
     * @var ?string $remove
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('remove')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $remove = null;

    /**
     * @param  ?\NoResponse\Models\Shared\ListEntryRequest  $add
     * @param  ?string  $remove
     * @phpstan-pure
     */
    public function __construct(?ListEntryRequest $add = null, ?string $remove = null)
    {
        $this->add = $add;
        $this->remove = $remove;
    }
}