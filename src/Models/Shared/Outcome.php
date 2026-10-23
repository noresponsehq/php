<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What the provider later learned about the assessed account. confirmed_abuse, account_takeover and chargeback report abuse; false_positive and legitimate withdraw an earlier abuse report of this workspace for the assessment; unknown is recorded only. Outcomes are append-only and the latest one recorded for an assessment wins. */
enum Outcome: string
{
    case ConfirmedAbuse = 'confirmed_abuse';
    case AccountTakeover = 'account_takeover';
    case Chargeback = 'chargeback';
    case FalsePositive = 'false_positive';
    case Legitimate = 'legitimate';
    case Unknown = 'unknown';
}
