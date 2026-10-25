<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** A stable reason code. New codes may appear; ignore any you do not know. */
enum ReasonCode: string
{
    case NoDigitalFootprint = 'no_digital_footprint';
    case VoipNumber = 'voip_number';
    case DisposableEmail = 'disposable_email';
    case NewEmail = 'new_email';
    case SpamReports = 'spam_reports';
    case FraudFlag = 'fraud_flag';
    case IdentityMismatch = 'identity_mismatch';
    case CountryMismatch = 'country_mismatch';
    case ProxyIp = 'proxy_ip';
    case SeenBefore = 'seen_before';
    case SharedIp = 'shared_ip';
    case ManyRecentAccounts = 'many_recent_accounts';
    case EstablishedAccounts = 'established_accounts';
    case AgedIdentity = 'aged_identity';
    case BreachNameMatch = 'breach_name_match';
    case BreachCooccurrence = 'breach_cooccurrence';
    case BreachNameMismatch = 'breach_name_mismatch';
    case BreachPhoneMismatch = 'breach_phone_mismatch';
    case RecentPasswordExposure = 'recent_password_exposure';
    case CredentialListExposure = 'credential_list_exposure';
    case AbuseEcosystemMember = 'abuse_ecosystem_member';
    case NoBreachHistory = 'no_breach_history';
    case AutomationFastSubmit = 'automation_fast_submit';
    case ClientClockSkew = 'client_clock_skew';
    case BotOrAutomation = 'bot_or_automation';
    case AuthEmailVerified = 'auth_email_verified';
    case AuthPhoneVerified = 'auth_phone_verified';
    case AuthMfaRecent = 'auth_mfa_recent';
    case AuthNewSession = 'auth_new_session';
    case AuthNewAccount = 'auth_new_account';
    case AuthImpersonated = 'auth_impersonated';
    case ContextTimezoneMismatch = 'context_timezone_mismatch';
    case ContextLocaleMismatch = 'context_locale_mismatch';
    case ContextLineCountryMismatch = 'context_line_country_mismatch';
    case PriorAbuseLink = 'prior_abuse_link';
    case TestScenario = 'test_scenario';
    case SharedApiKey = 'shared_api_key';
    case YoungEmailDomain = 'young_email_domain';
    case EmailDomainNoMx = 'email_domain_no_mx';
    case EmailDomainNonexistent = 'email_domain_nonexistent';
}
