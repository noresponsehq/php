<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class ServiceActor
{
    /**
     * The NoResponse service that made the change with no person acting, such as replenisher, which replaces dead platform sessions in NoResponse's own workspace.
     *
     * @var string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    public string $name;

    /**
     *
     * @var string $type
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('type')]
    public string $type;

    /**
     * @param  string  $type
     * @param  string  $name
     * @phpstan-pure
     */
    public function __construct(string $name, string $type = 'service')
    {
        $this->name = $name;
        $this->type = $type;
    }
}