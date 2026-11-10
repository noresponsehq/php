<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What matched. email, phone, supplied_handle and source_fact are hard identifiers; company, city and school are soft. */
enum ScreeningMatchEvidenceKind: string
{
    case Email = 'email';
    case Phone = 'phone';
    case SuppliedHandle = 'supplied_handle';
    case SourceFact = 'source_fact';
    case Name = 'name';
    case Company = 'company';
    case City = 'city';
    case School = 'school';
}
