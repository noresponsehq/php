<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PolicyEvaluationRequestCosts
{
    /**
     *
     * @var \NoResponse\Models\Shared\Cost $legitimate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('legitimate')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Cost')]
    public Cost $legitimate;

    /**
     *
     * @var \NoResponse\Models\Shared\Cost $abuse
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('abuse')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Cost')]
    public Cost $abuse;

    /**
     * @param  \NoResponse\Models\Shared\Cost  $legitimate
     * @param  \NoResponse\Models\Shared\Cost  $abuse
     * @phpstan-pure
     */
    public function __construct(Cost $legitimate, Cost $abuse)
    {
        $this->legitimate = $legitimate;
        $this->abuse = $abuse;
    }
}