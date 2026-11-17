<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** SuggestedSearch - A search enrichment would start: a distinctive or unique value of a likely record, not yet searched for the person. A person starts it with POST .../searches, naming the record and the field. */
class SuggestedSearch
{
    /**
     * The lookup record whose value enrichment would search. It is among the report's lookup records.
     *
     * @var string $recordId
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('record_id')]
    public string $recordId;

    /**
     * The field of that record that holds the value. Send record_id and field to POST .../searches to start the search.
     *
     * @var string $field
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('field')]
    public string $field;

    /**
     * The kind of the value: one of the kinds the environment's enrichment setting names.
     *
     * @var \NoResponse\Models\Shared\SuggestedSearchKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\SuggestedSearchKind|string')]
    public SuggestedSearchKind|string $kind;

    /**
     * The likelihood of the record that holds the value, from 0.01 to 0.99. Enrichment suggests a value only from a record more likely than the setting's min_likelihood, the likeliest first.
     *
     * @var float $likelihood
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('likelihood')]
    public float $likelihood;

    /**
     * @param  string  $recordId
     * @param  string  $field
     * @param  \NoResponse\Models\Shared\SuggestedSearchKind|string  $kind
     * @param  float  $likelihood
     * @phpstan-pure
     */
    public function __construct(string $recordId, string $field, SuggestedSearchKind|string $kind, float $likelihood)
    {
        $this->recordId = $recordId;
        $this->field = $field;
        $this->kind = $kind;
        $this->likelihood = $likelihood;
    }
}