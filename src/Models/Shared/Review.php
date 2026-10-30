<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class Review
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * Your own opaque identifier for the account being checked, scoped to your workspace. Use an id you mint, with no direct identifier (email, phone, name or national id) in it. '|' is accepted so an Auth0 user id such as 'auth0|64abc' passes unchanged; '@', '+', '$' and whitespace are refused by the pattern, as is an exact-shape JWT; a hex digest such as a SHA-256 is allowed, because hashing an internal id is a common pseudonymous scheme. A value such as '07700900123' or 'jane.doe.gmail.com' cannot be told apart from an opaque id. It travels in bodies, and in a URL only as the path segment of GET /v1/accounts/{account_id}, its /assessments and its /linked_accounts. An assessment requested by a provider hook at pre_registration, which has no account yet, carries the server-issued account_id pre: followed by its assessment_id.
     *
     * @var string $accountId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_id')]
    public string $accountId;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewStatus|string $status
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('status')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ReviewStatus|string')]
    public ReviewStatus|string $status;

    /**
     *
     * @var \NoResponse\Models\Shared\Priority|string $priority
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('priority')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Priority|string')]
    public Priority|string $priority;

    /**
     *
     * @var int $version
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('version')]
    public int $version;

    /**
     *
     * @var int $openedRiskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('opened_risk_version')]
    public int $openedRiskVersion;

    /**
     *
     * @var int $currentRiskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('current_risk_version')]
    public int $currentRiskVersion;

    /**
     *
     * @var string $createdBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_by')]
    public string $createdBy;

    /**
     *
     * @var string $updatedBy
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_by')]
    public string $updatedBy;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var string $updatedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('updated_at')]
    public string $updatedAt;

    /**
     *
     * @var string $expiresAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expires_at')]
    public string $expiresAt;

    /**
     *
     * @var ?string $assignee
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assignee')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assignee = null;

    /**
     *
     * @var ?\NoResponse\Models\Shared\Resolution $resolution
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('resolution')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Resolution|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Resolution $resolution = null;

    /**
     * Immutable workspace member ID. assignee is the historical display identity captured at assignment.
     *
     * @var ?string $assigneePrincipalId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('assignee_principal_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $assigneePrincipalId = null;

    /**
     * @param  string  $id
     * @param  string  $accountId
     * @param  \NoResponse\Models\Shared\ReviewStatus|string  $status
     * @param  \NoResponse\Models\Shared\Priority|string  $priority
     * @param  int  $version
     * @param  int  $openedRiskVersion
     * @param  int  $currentRiskVersion
     * @param  string  $createdBy
     * @param  string  $updatedBy
     * @param  string  $createdAt
     * @param  string  $updatedAt
     * @param  string  $expiresAt
     * @param  ?string  $assignee
     * @param  ?\NoResponse\Models\Shared\Resolution  $resolution
     * @param  ?string  $assigneePrincipalId
     * @phpstan-pure
     */
    public function __construct(string $id, string $accountId, ReviewStatus|string $status, Priority|string $priority, int $version, int $openedRiskVersion, int $currentRiskVersion, string $createdBy, string $updatedBy, string $createdAt, string $updatedAt, string $expiresAt, ?string $assignee = null, ?Resolution $resolution = null, ?string $assigneePrincipalId = null)
    {
        $this->id = $id;
        $this->accountId = $accountId;
        $this->status = $status;
        $this->priority = $priority;
        $this->version = $version;
        $this->openedRiskVersion = $openedRiskVersion;
        $this->currentRiskVersion = $currentRiskVersion;
        $this->createdBy = $createdBy;
        $this->updatedBy = $updatedBy;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->expiresAt = $expiresAt;
        $this->assignee = $assignee;
        $this->resolution = $resolution;
        $this->assigneePrincipalId = $assigneePrincipalId;
    }
}