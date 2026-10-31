<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** name_gender is the records' gender against the submitted first name's usual one. */
enum Attribute: string
{
    case BirthDate = 'birth_date';
    case Gender = 'gender';
    case Nationality = 'nationality';
    case NameGender = 'name_gender';
}
