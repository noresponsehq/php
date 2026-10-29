<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListEntry - One entry of an environment's list: an exact email or an email domain that decides an account whatever its score. An account matches when one of its admitted assessments sent the email, or an email of the domain. A block entry decides block for every flow and an allow entry decides allow; when both match, block wins. The account's risk carries the list_match reason with the entry's id, and its score stays the one the assessment's facts give. A held flow still waits for its investigation. */
class ListEntry
{
    /**
     * The entry's id: lst_ and a ULID.
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * The workspace id, which is also its live environment's workspace id; the test environment's is the same id with :test appended. A workspace created through the API is tnt_ and a 26-character ULID.
     *
     * @var string $workspaceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('workspace_id')]
    public string $workspaceId;

    /**
     * The environment the key belongs to. A live key assesses with live sources; a test key answers from the deterministic simulator.
     *
     * @var \NoResponse\Models\Shared\KeyEnvironment|string $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\KeyEnvironment|string')]
    public KeyEnvironment|string $environment;

    /**
     * email matches one address, whatever the case of its local part. email_domain matches every address of the registrable domain and of its subdomains.
     *
     * @var \NoResponse\Models\Shared\ListEntryKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListEntryKind|string')]
    public ListEntryKind|string $kind;

    /**
     * The value the entry matches, in canonical form: an email lower-cased whole, or a domain lower-cased and taken to its registrable domain (mail.example.co.uk is stored as example.co.uk).
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
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * The external user id of the member who added the entry through the console, or the prefix (nrk_<environment>_<key id>) of the management key that added it.
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     * Why the entry exists, for the people who manage the list. It is shown with the entry and decides nothing.
     *
     * @var ?string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $note = null;

    /**
     * Optional expiry. An expired entry stops matching immediately; bounded maintenance removes it and propagates account risk changes.
     *
     * @var ?string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $expiresAt = null;

    /**
     * @param  string  $id
     * @param  string  $workspaceId
     * @param  \NoResponse\Models\Shared\KeyEnvironment|string  $environment
     * @param  \NoResponse\Models\Shared\ListEntryKind|string  $kind
     * @param  string  $value
     * @param  \NoResponse\Models\Shared\ListEntryAction|string  $action
     * @param  string  $createdAt
     * @param  string  $createdBy
     * @param  ?string  $note
     * @param  ?string  $expiresAt
     * @phpstan-pure
     */
    public function __construct(string $id, string $workspaceId, KeyEnvironment|string $environment, ListEntryKind|string $kind, string $value, ListEntryAction|string $action, string $createdAt, string $createdBy, ?string $note = null, ?string $expiresAt = null)
    {
        $this->id = $id;
        $this->workspaceId = $workspaceId;
        $this->environment = $environment;
        $this->kind = $kind;
        $this->value = $value;
        $this->action = $action;
        $this->createdAt = $createdAt;
        $this->createdBy = $createdBy;
        $this->note = $note;
        $this->expiresAt = $expiresAt;
    }
}