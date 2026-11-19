<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** found_by: what found the record, which sets where its likelihood starts. agrees: a value the record shares with what the investigator gave or with a joined record. clashes: a birth date, full name, gender or country that differs from theirs. */
enum RecordEvidenceSignal: string
{
    case FoundBy = 'found_by';
    case Agrees = 'agrees';
    case Clashes = 'clashes';
}
