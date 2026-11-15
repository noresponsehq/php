<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** WorkspacePersonResult - Create or reuse a workspace person. */
class WorkspacePersonResult
{
    /**
     *
     * @var \NoResponse\Models\Shared\WorkspacePerson $person
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('person')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\WorkspacePerson')]
    public WorkspacePerson $person;

    /**
     * $suggestedMatches
     *
     * @var array<\NoResponse\Models\Shared\PersonMatch> $suggestedMatches
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('suggested_matches')]
    #[\NoResponse\Serializer\Annotation\Type('array<\NoResponse\Models\Shared\PersonMatch>')]
    public array $suggestedMatches;

    /**
     *
     * @var bool $created
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('created')]
    public bool $created;

    /**
     * @param  \NoResponse\Models\Shared\WorkspacePerson  $person
     * @param  array<\NoResponse\Models\Shared\PersonMatch>  $suggestedMatches
     * @param  bool  $created
     * @phpstan-pure
     */
    public function __construct(WorkspacePerson $person, array $suggestedMatches, bool $created)
    {
        $this->person = $person;
        $this->suggestedMatches = $suggestedMatches;
        $this->created = $created;
    }
}