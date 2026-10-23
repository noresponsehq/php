<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequestIdentifiers - At least one of email, username or phone. name and ip refine the match and travel beside a lookup identifier; a body with only name or ip is refused with 400. */
class AssessmentRequestIdentifiers
{
    /**
     * One address: a 1 to 64 character local part without whitespace, angle brackets, control or invisible characters, '@', and a domain with a letter TLD. Send an internationalised domain in punycode. Nothing is trimmed. The local part keeps its case and the domain is lower-cased; no alias rewriting ('+tag', dots or provider heuristics) is applied.
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     * The handle the account is signing up with: 1 to 64 characters, no whitespace, control or invisible characters, and not a credential hash or token. Echoed as received; compared case-insensitively.
     *
     * @var ?string $username
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('username')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $username = null;

    /**
     * Strict E.164: '+', then 8 to 15 digits, the first not 0, with no separators. Phone evidence is gathered asynchronously, so a phone-only request answers 202 pending and the phone is listed in incomplete_sources on the synchronous answer.
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     * The full name as the user typed it, 1 to 128 characters with no control or invisible characters. It is used only to match names in the evidence.
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     * The account_creation's client IP address: an IPv4 dotted quad without leading zeros, or an IPv6 address in its RFC 5952 text form (lower case, no leading zeros, the longest zero run compressed). Send an IPv4 client as a dotted quad, not IPv4-mapped. No zone, port or prefix. The server refuses a non-canonical IPv6 spelling, and every private, loopback, link-local, multicast, documentation or otherwise reserved address (the IANA special-purpose registries), with 400: only a public address says anything about a signup.
     *
     * @var ?string $ip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('ip')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $ip = null;

    /**
     * @param  ?string  $email
     * @param  ?string  $username
     * @param  ?string  $phone
     * @param  ?string  $name
     * @param  ?string  $ip
     * @phpstan-pure
     */
    public function __construct(?string $email = null, ?string $username = null, ?string $phone = null, ?string $name = null, ?string $ip = null)
    {
        $this->email = $email;
        $this->username = $username;
        $this->phone = $phone;
        $this->name = $name;
        $this->ip = $ip;
    }
}