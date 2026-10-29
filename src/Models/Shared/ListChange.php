<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListChange - A committed bulk list change and bounded notification progress, available while propagation is pending and for 24 hours after all propagation completes. References count an account once per changed list entry and are not unique accounts. No endpoint delivery or customer enforcement is implied by completed. */
class ListChange
{
    /**
     *
     * @var string $id
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('id')]
    public string $id;

    /**
     *
     * @var string $createdAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created_at')]
    public string $createdAt;

    /**
     *
     * @var \NoResponse\Models\Shared\ListChangeState|string $state
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListChangeState|string')]
    public ListChangeState|string $state;

    /**
     * $added
     *
     * @var array<\NoResponse\Models\Shared\ListEntry> $added
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('added')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ListEntry>')]
    public array $added;

    /**
     * $removed
     *
     * @var array<string> $removed
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('removed')]
    #[\NoResponse\Serializer\Annotation\Type('array<string>')]
    public array $removed;

    /**
     *
     * @var int $pendingPropagations
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('pending_propagations')]
    public int $pendingPropagations;

    /**
     *
     * @var int $processedAccountReferences
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('processed_account_references')]
    public int $processedAccountReferences;

    /**
     * @param  string  $id
     * @param  string  $createdAt
     * @param  \NoResponse\Models\Shared\ListChangeState|string  $state
     * @param  array<\NoResponse\Models\Shared\ListEntry>  $added
     * @param  array<string>  $removed
     * @param  int  $pendingPropagations
     * @param  int  $processedAccountReferences
     * @phpstan-pure
     */
    public function __construct(string $id, string $createdAt, ListChangeState|string $state, array $added, array $removed, int $pendingPropagations, int $processedAccountReferences)
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->state = $state;
        $this->added = $added;
        $this->removed = $removed;
        $this->pendingPropagations = $pendingPropagations;
        $this->processedAccountReferences = $processedAccountReferences;
    }
}