<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** unique: an email or phone, which belongs to one person by design. distinctive: rare enough that a new search on it likely finds one person. common: shared by many people, so a search on it finds strangers. A new search is suggested for unique and distinctive values only; any value can still be searched. */
enum Rating: string
{
    case Unique = 'unique';
    case Distinctive = 'distinctive';
    case Common = 'common';
}
