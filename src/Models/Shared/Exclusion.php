<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


enum Exclusion: string
{
    case ExpiredOrErasedRecords = 'expired_or_erased_records';
    case SecretsAndCredentialDigests = 'secrets_and_credential_digests';
    case PrivateSourceAndWorkPayloads = 'private_source_and_work_payloads';
    case CrossCustomerData = 'cross_customer_data';
    case LegacyOutcomeNotes = 'legacy_outcome_notes';
    case UncapturedHistoricalDecisions = 'uncaptured_historical_decisions';
    case InvestigatorReviewsRequireReviewExport = 'investigator_reviews_require_review_export';
}
