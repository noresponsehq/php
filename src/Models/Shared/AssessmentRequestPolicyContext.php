<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class AssessmentRequestPolicyContext
{
    /**
     * The provider flow the assessment gates. Absent means signup.
     *
     * @var ?\NoResponse\Models\Shared\Flow $flow
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('flow')]
    #[\Speakeasy\Serializer\Annotation\Type('\NoResponse\Models\Shared\Flow|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?Flow $flow = null;

    /**
     * ISO 3166-1 alpha-2 region of the signup, as the provider determines it.
     *
     * @var ?string $region
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('region')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $region = null;

    /**
     * @param  ?\NoResponse\Models\Shared\Flow  $flow
     * @param  ?string  $region
     * @phpstan-pure
     */
    public function __construct(?Flow $flow = null, ?string $region = null)
    {
        $this->flow = $flow;
        $this->region = $region;
    }
}