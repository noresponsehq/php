<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Which common field a value is, where many sources share it: a join date and a birth date are both dates, with the roles joined and born. A platform account's field and a breach row's column with the same meaning carry the same kind and role. A linked_account field is named by its network. Absent for a field only its source returns. */
enum RecordRole: string
{
    case AccountId = 'account_id';
    case AccountStatus = 'account_status';
    case AccountType = 'account_type';
    case AlternatePhone = 'alternate_phone';
    case Balance = 'balance';
    case Banned = 'banned';
    case Bio = 'bio';
    case Born = 'born';
    case Bot = 'bot';
    case CallerCategory = 'caller_category';
    case CoverPicture = 'cover_picture';
    case Deleted = 'deleted';
    case DeletedOn = 'deleted_on';
    case Department = 'department';
    case DisplayName = 'display_name';
    case EmailVerified = 'email_verified';
    case Expires = 'expires';
    case FirstName = 'first_name';
    case Followers = 'followers';
    case Following = 'following';
    case Friends = 'friends';
    case FullAddress = 'full_address';
    case FullName = 'full_name';
    case Handle = 'handle';
    case Headline = 'headline';
    case Interests = 'interests';
    case JobTitle = 'job_title';
    case Joined = 'joined';
    case LastActive = 'last_active';
    case LastIp = 'last_ip';
    case LastName = 'last_name';
    case LastPost = 'last_post';
    case LastUpdated = 'last_updated';
    case Level = 'level';
    case LikesGiven = 'likes_given';
    case LikesReceived = 'likes_received';
    case LineType = 'line_type';
    case LinkedAccount = 'linked_account';
    case Location = 'location';
    case MarkedSpam = 'marked_spam';
    case MiddleName = 'middle_name';
    case Nationality = 'nationality';
    case Organisation = 'organisation';
    case OtherIp = 'other_ip';
    case Paid = 'paid';
    case PasswordChanged = 'password_changed';
    case Picture = 'picture';
    case Points = 'points';
    case Posts = 'posts';
    case Private = 'private';
    case ProfileLink = 'profile_link';
    case ProfileViews = 'profile_views';
    case Rating = 'rating';
    case Referrals = 'referrals';
    case Referrer = 'referrer';
    case ReportCount = 'report_count';
    case Reputation = 'reputation';
    case ReputationLabel = 'reputation_label';
    case Residence = 'residence';
    case Salutation = 'salutation';
    case School = 'school';
    case Signature = 'signature';
    case SignupIp = 'signup_ip';
    case SiteRole = 'site_role';
    case SpamScore = 'spam_score';
    case Street = 'street';
    case Verified = 'verified';
    case Warnings = 'warnings';
    case Website = 'website';
}
