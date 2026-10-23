<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** AssessmentRequestPolicyContext - Optional policy inputs: region. */
class AssessmentRequestPolicyContext
{
    /**
     * ISO 3166-1 alpha-2 region of the signup, as the provider determines it.
     *
     * @var ?string $region
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('region')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $region = null;

    /**
     * @param  ?string  $region
     * @phpstan-pure
     */
    public function __construct(?string $region = null)
    {
        $this->region = $region;
    }
}