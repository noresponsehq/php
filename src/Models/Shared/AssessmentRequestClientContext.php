<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequestClientContext - Optional context observed by your signup client. The server parses these hints into coarse features, leaves raw user_agent and opaque ids out of every answer, and weighs a mismatch with the other evidence. */
class AssessmentRequestClientContext
{
    /**
     * IANA time-zone name such as Europe/London or America/Los_Angeles. Fixed numeric offsets are not accepted.
     *
     * @var ?string $timezone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('timezone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $timezone = null;

    /**
     * BCP 47 locale, for example en-AU. Treat as a presentation hint, not a nationality signal.
     *
     * @var ?string $locale
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('locale')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $locale = null;

    /**
     * Client platform. Closed vocabulary keeps integrations stable.
     *
     * @var ?\NoResponse\Models\Shared\Platform $platform
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('platform')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Platform|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?Platform $platform = null;

    /**
     * Customer application version, without build metadata that contains secrets.
     *
     * @var ?string $appVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('app_version')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $appVersion = null;

    /**
     * The raw User-Agent header of the signup request, at most 512 characters. It is parsed into coarse features and left out of every answer.
     *
     * @var ?string $userAgent
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('user_agent')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $userAgent = null;

    /**
     * Tenant-scoped opaque identifier your application mints and rotates when the account or device changes. Send an id of your own, not a hardware fingerprint.
     *
     * @var ?string $deviceId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('device_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $deviceId = null;

    /**
     * Opaque signup session identifier. It is used for tenant-scoped velocity and replay checks only.
     *
     * @var ?string $sessionId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('session_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $sessionId = null;

    /**
     * Elapsed time from form start to submit. Values below three seconds are a weak automation hint, weighed with the other evidence.
     *
     * @var ?int $formDurationMs
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('form_duration_ms')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $formDurationMs = null;

    /**
     * RFC 3339 timestamp observed by the client. Server ingress time remains authoritative; a large clock skew is only a low-confidence feature.
     *
     * @var ?string $clientObservedAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('client_observed_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $clientObservedAt = null;

    /**
     * @param  ?string  $timezone
     * @param  ?string  $locale
     * @param  ?\NoResponse\Models\Shared\Platform  $platform
     * @param  ?string  $appVersion
     * @param  ?string  $userAgent
     * @param  ?string  $deviceId
     * @param  ?string  $sessionId
     * @param  ?int  $formDurationMs
     * @param  ?string  $clientObservedAt
     * @phpstan-pure
     */
    public function __construct(?string $timezone = null, ?string $locale = null, ?Platform $platform = null, ?string $appVersion = null, ?string $userAgent = null, ?string $deviceId = null, ?string $sessionId = null, ?int $formDurationMs = null, ?string $clientObservedAt = null)
    {
        $this->timezone = $timezone;
        $this->locale = $locale;
        $this->platform = $platform;
        $this->appVersion = $appVersion;
        $this->userAgent = $userAgent;
        $this->deviceId = $deviceId;
        $this->sessionId = $sessionId;
        $this->formDurationMs = $formDurationMs;
        $this->clientObservedAt = $clientObservedAt;
    }
}