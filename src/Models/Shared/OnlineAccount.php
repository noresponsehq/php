<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** OnlineAccount - One online-account search of the signup's email or username, detailed view only. name and domain name the platform searched, not a provider. outcome is the search's signal outcome: found, not_found, or a failure (blocked, unavailable, inconclusive) with its reason; a failure is not reported as not_found. The members after reason are what the platform returned beside an account it found, each absent when it did not say. */
class OnlineAccount
{
    /**
     * The platform's name, such as Adobe or GitHub.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     * The platform's domain, lower case: the host its logo is fetched for.
     *
     * @var string $domain
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('domain')]
    public string $domain;

    /**
     *
     * @var \NoResponse\Models\Shared\Identifier|string $identifier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('identifier')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Identifier|string')]
    public Identifier|string $identifier;

    /**
     * Per-signal outcome. A source that timed out, was blocked or errored reports blocked, unavailable or inconclusive with a reason and is listed in incomplete_sources; not_found is a definite absence.
     *
     * @var \NoResponse\Models\Shared\SignalOutcome|string $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SignalOutcome|string')]
    public SignalOutcome|string $outcome;

    /**
     * Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it.
     *
     * @var \NoResponse\Models\Shared\FailureReason|string|null $reason
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reason')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FailureReason|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public FailureReason|string|null $reason = null;

    /**
     * How the account signs in, as the platform reports it, sorted: a password, a Google, Facebook, Apple or Microsoft account, the organisation's single sign-on, or another method.
     *
     * @var array<\NoResponse\Models\Shared\SignIn|string>|null $signIn
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('sign_in')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\SignIn|string>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $signIn = null;

    /**
     * Whether the platform says the account's email is verified.
     *
     * @var ?bool $emailVerified
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email_verified')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $emailVerified = null;

    /**
     * Whether the platform says the account is blocked or suspended.
     *
     * @var ?bool $blocked
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('blocked')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $blocked = null;

    /**
     * personal, or business: an account a company or school manages.
     *
     * @var \NoResponse\Models\Shared\AccountType|string|null $accountType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('account_type')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AccountType|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public AccountType|string|null $accountType = null;

    /**
     * Whether the account has its own profile picture rather than the platform's default. The picture is not returned.
     *
     * @var ?bool $hasAvatar
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('has_avatar')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?bool $hasAvatar = null;

    /**
     * The first letters of the account holder's first name, as the platform shows them (Life360 shows two and hides the rest). It is evidence only: it does not change the score or the consistency results.
     *
     * @var ?string $firstNamePrefix
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('first_name_prefix')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $firstNamePrefix = null;

    /**
     * @param  string  $name
     * @param  string  $domain
     * @param  \NoResponse\Models\Shared\Identifier|string  $identifier
     * @param  \NoResponse\Models\Shared\SignalOutcome|string  $outcome
     * @param  \NoResponse\Models\Shared\FailureReason|string|null  $reason
     * @param  array<\NoResponse\Models\Shared\SignIn|string>|null  $signIn
     * @param  ?bool  $emailVerified
     * @param  ?bool  $blocked
     * @param  \NoResponse\Models\Shared\AccountType|string|null  $accountType
     * @param  ?bool  $hasAvatar
     * @param  ?string  $firstNamePrefix
     * @phpstan-pure
     */
    public function __construct(string $name, string $domain, Identifier|string $identifier, SignalOutcome|string $outcome, FailureReason|string|null $reason = null, ?array $signIn = null, ?bool $emailVerified = null, ?bool $blocked = null, AccountType|string|null $accountType = null, ?bool $hasAvatar = null, ?string $firstNamePrefix = null)
    {
        $this->name = $name;
        $this->domain = $domain;
        $this->identifier = $identifier;
        $this->outcome = $outcome;
        $this->reason = $reason;
        $this->signIn = $signIn;
        $this->emailVerified = $emailVerified;
        $this->blocked = $blocked;
        $this->accountType = $accountType;
        $this->hasAvatar = $hasAvatar;
        $this->firstNamePrefix = $firstNamePrefix;
    }
}