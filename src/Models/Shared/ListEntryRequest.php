<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListEntryRequest - POST /v1/workspaces/{workspace_id}/lists/{environment} body. Adds one entry to the environment's list and, in the same change, re-decides every account it matches: each sends account.risk_changed when a decision changes. Needs the admin or owner role, or a management key of the environment. */
class ListEntryRequest
{
    /**
     * email matches one address, whatever the case of its local part. email_domain matches every address of the registrable domain and of its subdomains.
     *
     * @var \NoResponse\Models\Shared\ListEntryKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListEntryKind|string')]
    public ListEntryKind|string $kind;

    /**
     * An email address for kind email, written as in an assessment request; an LDH domain (A-label for an internationalised one) such as example.com for kind email_domain, which must sit below a public suffix (co.uk alone is refused with 400). NoResponse stores it in canonical form and answers that form.
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     * block decides block for the accounts the entry matches; allow decides allow. Block wins when both match.
     *
     * @var \NoResponse\Models\Shared\ListEntryAction|string $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListEntryAction|string')]
    public ListEntryAction|string $action;

    /**
     * Why the entry exists, for the people who manage the list. It is shown with the entry and decides nothing.
     *
     * @var ?string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $note = null;

    /**
     * @param  \NoResponse\Models\Shared\ListEntryKind|string  $kind
     * @param  string  $value
     * @param  \NoResponse\Models\Shared\ListEntryAction|string  $action
     * @param  ?string  $note
     * @phpstan-pure
     */
    public function __construct(ListEntryKind|string $kind, string $value, ListEntryAction|string $action, ?string $note = null)
    {
        $this->kind = $kind;
        $this->value = $value;
        $this->action = $action;
        $this->note = $note;
    }
}