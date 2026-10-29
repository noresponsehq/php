<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ListImpact - List override changes among the newest 5000 matching accounts. These counts describe override inputs. Customer enforcement and eventual outcomes remain separate. The response reports whether the matching population was truncated. */
class ListImpact
{
    /**
     *
     * @var \NoResponse\Models\Shared\ListImpactKind|string $kind
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('kind')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ListImpactKind|string')]
    public ListImpactKind|string $kind;

    /**
     *
     * @var string $value
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('value')]
    public string $value;

    /**
     *
     * @var \NoResponse\Models\Shared\Action|string $action
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('action')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\Action|string')]
    public Action|string $action;

    /**
     *
     * @var int $matchedAccounts
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_accounts')]
    public int $matchedAccounts;

    /**
     *
     * @var int $changedOverrides
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('changed_overrides')]
    public int $changedOverrides;

    /**
     *
     * @var bool $truncated
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('truncated')]
    public bool $truncated;

    /**
     * $transitions
     *
     * @var array<\NoResponse\Models\Shared\ListImpactTransition> $transitions
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('transitions')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\ListImpactTransition>')]
    public array $transitions;

    /**
     *
     * @var ?string $remove
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('remove')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $remove = null;

    /**
     *
     * @var string $scope
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('scope')]
    public string $scope;

    /**
     *
     * @var bool $historicalPopulationKnown
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('historical_population_known')]
    public bool $historicalPopulationKnown;

    /**
     * @param  string  $scope
     * @param  \NoResponse\Models\Shared\ListImpactKind|string  $kind
     * @param  string  $value
     * @param  \NoResponse\Models\Shared\Action|string  $action
     * @param  int  $matchedAccounts
     * @param  int  $changedOverrides
     * @param  bool  $truncated
     * @param  bool  $historicalPopulationKnown
     * @param  array<\NoResponse\Models\Shared\ListImpactTransition>  $transitions
     * @param  ?string  $remove
     * @phpstan-pure
     */
    public function __construct(ListImpactKind|string $kind, string $value, Action|string $action, int $matchedAccounts, int $changedOverrides, bool $truncated, array $transitions, ?string $remove = null, string $scope = 'current_list_override_inputs', bool $historicalPopulationKnown = false)
    {
        $this->kind = $kind;
        $this->value = $value;
        $this->action = $action;
        $this->matchedAccounts = $matchedAccounts;
        $this->changedOverrides = $changedOverrides;
        $this->truncated = $truncated;
        $this->transitions = $transitions;
        $this->remove = $remove;
        $this->scope = $scope;
        $this->historicalPopulationKnown = $historicalPopulationKnown;
    }
}