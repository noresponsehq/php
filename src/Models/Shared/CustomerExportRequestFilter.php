<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class CustomerExportRequestFilter
{
    /**
     *
     * @var ?string $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $action = null;

    /**
     *
     * @var ?string $actor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('actor')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $actor = null;

    /**
     *
     * @var ?string $targetType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('target_type')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $targetType = null;

    /**
     *
     * @var ?string $targetId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('target_id')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $targetId = null;

    /**
     *
     * @var \NoResponse\Models\Shared\Environment|string|null $environment
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('environment')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Environment|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public Environment|string|null $environment = null;

    /**
     *
     * @var \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string|null $outcome
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('outcome')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public CustomerExportRequestFilterOutcome|string|null $outcome = null;

    /**
     *
     * @var ?string $since
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('since')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $since = null;

    /**
     *
     * @var ?string $until
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('until')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $until = null;

    /**
     * @param  ?string  $action
     * @param  ?string  $actor
     * @param  ?string  $targetType
     * @param  ?string  $targetId
     * @param  \NoResponse\Models\Shared\Environment|string|null  $environment
     * @param  \NoResponse\Models\Shared\CustomerExportRequestFilterOutcome|string|null  $outcome
     * @param  ?string  $since
     * @param  ?string  $until
     * @phpstan-pure
     */
    public function __construct(?string $action = null, ?string $actor = null, ?string $targetType = null, ?string $targetId = null, Environment|string|null $environment = null, CustomerExportRequestFilterOutcome|string|null $outcome = null, ?string $since = null, ?string $until = null)
    {
        $this->action = $action;
        $this->actor = $actor;
        $this->targetType = $targetType;
        $this->targetId = $targetId;
        $this->environment = $environment;
        $this->outcome = $outcome;
        $this->since = $since;
        $this->until = $until;
    }
}