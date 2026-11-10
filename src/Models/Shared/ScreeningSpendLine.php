<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** ScreeningSpendLine - What one implementation cost. */
class ScreeningSpendLine
{
    /**
     * The resolver, collector or analyser that produced a record, by its catalogue name.
     *
     * @var string $implementation
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('implementation')]
    public string $implementation;

    /**
     *
     * @var \NoResponse\Models\Shared\ScreeningSpendLineRole|string $role
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('role')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\ScreeningSpendLineRole|string')]
    public ScreeningSpendLineRole|string $role;

    /**
     *
     * @var int $spendMinor
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spend_minor')]
    public int $spendMinor;

    /**
     * @param  string  $implementation
     * @param  \NoResponse\Models\Shared\ScreeningSpendLineRole|string  $role
     * @param  int  $spendMinor
     * @phpstan-pure
     */
    public function __construct(string $implementation, ScreeningSpendLineRole|string $role, int $spendMinor)
    {
        $this->implementation = $implementation;
        $this->role = $role;
        $this->spendMinor = $spendMinor;
    }
}