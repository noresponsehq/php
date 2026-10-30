<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Machine codes an HTTP 403 answer can carry. */
enum PermissionDeniedErrorCode: string
{
    case WorkspaceForbidden = 'workspace_forbidden';
    case RoleForbidden = 'role_forbidden';
    case EmailUnverified = 'email_unverified';
    case OnboardingInReview = 'onboarding_in_review';
    case OnboardingRefused = 'onboarding_refused';
}
