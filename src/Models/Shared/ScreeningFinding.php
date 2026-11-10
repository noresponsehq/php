<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningFinding - Something the analyser flagged. band is capped by the strongest match among the profiles of its evidence: possible at most moderate, probable at most high. capped_from is the band the analyser gave when the cap lowered it. */
class ScreeningFinding
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     * What a finding is about: a direct threat to the principal or the event, intent to harm without a named target, fixation on the principal, a grievance against the host, research into the venue, route or security, weapons tied to any of these, disruption or protest planning toward this event, violent extremist content or identification, prior harassment or stalking of staff or principals, or posting the principal's addresses or movements.
     *
     * @var \NoResponse\Models\Shared\FindingCategory|string $category
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('category')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FindingCategory|string')]
    public FindingCategory|string $category;

    /**
     * How severe a finding is, most severe first.
     *
     * @var \NoResponse\Models\Shared\FindingBand|string $band
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('band')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FindingBand|string')]
    public FindingBand|string $band;

    /**
     *
     * @var float $confidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('confidence')]
    public float $confidence;

    /**
     *
     * @var string $rationale
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('rationale')]
    public string $rationale;

    /**
     * The posts and media that support the finding.
     *
     * @var array<string> $evidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $evidence;

    /**
     * The resolver, collector or analyser that produced a record, by its catalogue name.
     *
     * @var string $analyser
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('analyser')]
    public string $analyser;

    /**
     *
     * @var string $model
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('model')]
    public string $model;

    /**
     * What the analysis cost, in US cents.
     *
     * @var int $spendMinor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spend_minor')]
    public int $spendMinor;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     * How severe a finding is, most severe first.
     *
     * @var \NoResponse\Models\Shared\FindingBand|string|null $cappedFrom
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('capped_from')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\FindingBand|string|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public FindingBand|string|null $cappedFrom = null;

    /**
     * The exact words of the first evidence item that the finding rests on, as the analyser quoted them.
     *
     * @var ?string $quote
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('quote')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $quote = null;

    /**
     * @param  string  $id
     * @param  \NoResponse\Models\Shared\FindingCategory|string  $category
     * @param  \NoResponse\Models\Shared\FindingBand|string  $band
     * @param  float  $confidence
     * @param  string  $rationale
     * @param  array<string>  $evidence
     * @param  string  $analyser
     * @param  string  $model
     * @param  int  $spendMinor
     * @param  string  $createdAt
     * @param  \NoResponse\Models\Shared\FindingBand|string|null  $cappedFrom
     * @param  ?string  $quote
     * @phpstan-pure
     */
    public function __construct(string $id, FindingCategory|string $category, FindingBand|string $band, float $confidence, string $rationale, array $evidence, string $analyser, string $model, int $spendMinor, string $createdAt, FindingBand|string|null $cappedFrom = null, ?string $quote = null)
    {
        $this->id = $id;
        $this->category = $category;
        $this->band = $band;
        $this->confidence = $confidence;
        $this->rationale = $rationale;
        $this->evidence = $evidence;
        $this->analyser = $analyser;
        $this->model = $model;
        $this->spendMinor = $spendMinor;
        $this->createdAt = $createdAt;
        $this->cappedFrom = $cappedFrom;
        $this->quote = $quote;
    }
}