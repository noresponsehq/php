<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum ReviewSubjectKind: string
{
    case Account = 'account';
    case Assessment = 'assessment';
    case IssuedCredential = 'issued_credential';
}
