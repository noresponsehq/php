<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ReviewResolveRequest
{
    /**
     *
     * @var int $expectedVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_version')]
    public int $expectedVersion;

    /**
     *
     * @var int $expectedRiskVersion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('expected_risk_version')]
    public int $expectedRiskVersion;

    /**
     *
     * @var \NoResponse\Models\Shared\Conclusion|string $conclusion
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('conclusion')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Conclusion|string')]
    public Conclusion|string $conclusion;

    /**
     *
     * @var string $note
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('note')]
    public string $note;

    /**
     * @param  int  $expectedVersion
     * @param  int  $expectedRiskVersion
     * @param  \NoResponse\Models\Shared\Conclusion|string  $conclusion
     * @param  string  $note
     * @phpstan-pure
     */
    public function __construct(int $expectedVersion, int $expectedRiskVersion, Conclusion|string $conclusion, string $note)
    {
        $this->expectedVersion = $expectedVersion;
        $this->expectedRiskVersion = $expectedRiskVersion;
        $this->conclusion = $conclusion;
        $this->note = $note;
    }
}