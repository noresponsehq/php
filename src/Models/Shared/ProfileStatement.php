<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ProfileStatement
{
    /**
     *
     * @var \NoResponse\Models\Shared\Topic|string $topic
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('topic')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Topic|string')]
    public Topic|string $topic;

    /**
     *
     * @var string $text
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('text')]
    public string $text;

    /**
     * confirmed: a linked record or the searched identifier states it directly. likely: a strong inference. possible: a weak inference.
     *
     * @var \NoResponse\Models\Shared\Certainty|string $certainty
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('certainty')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Certainty|string')]
    public Certainty|string $certainty;

    /**
     * stated: read from a record. inferred: reasoned from several facts. absence: every source answered and none found it.
     *
     * @var \NoResponse\Models\Shared\Basis|string $basis
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('basis')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Basis|string')]
    public Basis|string $basis;

    /**
     * Other explanations to keep open for an inference.
     *
     * @var array<string> $alternatives
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('alternatives')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $alternatives;

    /**
     * Every record, post or check the statement rests on.
     *
     * @var array<\NoResponse\Models\Shared\ProfileCitation> $evidence
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('evidence')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ProfileCitation>')]
    public array $evidence;

    /**
     * @param  \NoResponse\Models\Shared\Topic|string  $topic
     * @param  string  $text
     * @param  \NoResponse\Models\Shared\Certainty|string  $certainty
     * @param  \NoResponse\Models\Shared\Basis|string  $basis
     * @param  array<string>  $alternatives
     * @param  array<\NoResponse\Models\Shared\ProfileCitation>  $evidence
     * @phpstan-pure
     */
    public function __construct(Topic|string $topic, string $text, Certainty|string $certainty, Basis|string $basis, array $alternatives, array $evidence)
    {
        $this->topic = $topic;
        $this->text = $text;
        $this->certainty = $certainty;
        $this->basis = $basis;
        $this->alternatives = $alternatives;
        $this->evidence = $evidence;
    }
}