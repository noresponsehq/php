<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Utils\NoResponseMetadata;
class ListWorkspacePeopleRequest
{
    /**
     * Pass next_cursor from the prior page.
     *
     * @var ?string $after
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=after')]
    public ?string $after = null;

    /**
     * Return only people whose email is this address, compared without case or surrounding spaces.
     *
     * @var ?string $email
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=email')]
    public ?string $email = null;

    /**
     * Return only people whose phone is this number, compared without surrounding spaces.
     *
     * @var ?string $phone
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=phone')]
    public ?string $phone = null;

    /**
     *
     * @var ?int $limit
     */
    #[NoResponseMetadata('queryParam:style=form,explode=true,name=limit')]
    public ?int $limit = null;

    /**
     * @param  ?int  $limit
     * @param  ?string  $after
     * @param  ?string  $email
     * @param  ?string  $phone
     * @phpstan-pure
     */
    public function __construct(?string $after = null, ?string $email = null, ?string $phone = null, ?int $limit = 100)
    {
        $this->after = $after;
        $this->email = $email;
        $this->phone = $phone;
        $this->limit = $limit;
    }
}