<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** Which common field a value is, where many sources share it: a join date and a birth date are both dates, with the roles joined and born. A platform account's field and a breach row's column with the same meaning carry the same kind and role. A linked_account field is named by its network. Absent for a field only its source returns. Each role's description names the kinds its values have. */
enum RecordRole: string
{
    // The platform's own id for the account (`account_id`).
    case AccountId = 'account_id';
    // The state of the account, such as active or suspended (`label`).
    case AccountStatus = 'account_status';
    // The sort of account, such as personal or business (`label`).
    case AccountType = 'account_type';
    // A mobile, alternate or fax number beside the main one (`phone`).
    case AlternatePhone = 'alternate_phone';
    // Money held on the account (`amount`).
    case Balance = 'balance';
    // Whether the site banned the account (`flag`).
    case Banned = 'banned';
    // What the person wrote about themselves (`long_text`).
    case Bio = 'bio';
    // The date of birth (`date` or `date_time`).
    case Born = 'born';
    // Whether the site marks the account as a bot (`flag`).
    case Bot = 'bot';
    // The category callers give a phone number, such as telemarketer (`label`).
    case CallerCategory = 'caller_category';
    // How many chargebacks a shop recorded against the account, or whether it has one (`count` or `flag`).
    case Chargebacks = 'chargebacks';
    // Another account on the same platform the account deals with, such as an opponent it plays most or a follower (`username`). Fields beside it under the same name say how, how often and when last. It names another person, never the account's owner.
    case Contact = 'contact';
    // The banner picture of the profile (`image`).
    case CoverPicture = 'cover_picture';
    // How many of the account's payments a shop declined (`count`).
    case Declines = 'declines';
    // Whether the account is deleted or inactive (`flag`).
    case Deleted = 'deleted';
    // When the account was deleted (`date` or `date_time`).
    case DeletedOn = 'deleted_on';
    // A department the source names (`text`).
    case Department = 'department';
    // The name the account shows (`person_name`).
    case DisplayName = 'display_name';
    // Whether the site verified the email (`flag`).
    case EmailVerified = 'email_verified';
    // When the account or its subscription expires (`date` or `date_time`).
    case Expires = 'expires';
    // A first name (`person_name`).
    case FirstName = 'first_name';
    // How many accounts follow the account (`count`).
    case Followers = 'followers';
    // How many accounts the account follows (`count`).
    case Following = 'following';
    // How many friends the account has (`count`).
    case Friends = 'friends';
    // A whole postal address on one line (`address`).
    case FullAddress = 'full_address';
    // A whole name (`person_name`).
    case FullName = 'full_name';
    // The handle of the account (`username`).
    case Handle = 'handle';
    // A headline or user title shown with the name (`text`).
    case Headline = 'headline';
    // Interests the person lists (`text`).
    case Interests = 'interests';
    // A job title the source states (`job_title`).
    case JobTitle = 'job_title';
    // When the account was made (`date` or `date_time`).
    case Joined = 'joined';
    // When the account was last active (`date` or `date_time`).
    case LastActive = 'last_active';
    // The IP the account last used (`ip`).
    case LastIp = 'last_ip';
    // A last name (`person_name`).
    case LastName = 'last_name';
    // When the account last posted (`date` or `date_time`).
    case LastPost = 'last_post';
    // When the account or its profile last changed (`date` or `date_time`).
    case LastUpdated = 'last_updated';
    // A level or rank on the site (`label`).
    case Level = 'level';
    // How many likes the account gave (`count`).
    case LikesGiven = 'likes_given';
    // How many likes the account received (`count`).
    case LikesReceived = 'likes_received';
    // The line type of a phone number, such as mobile or VoIP (`label`).
    case LineType = 'line_type';
    // An account on another network. The field's name names the network (`username`, `account_id` or `url`).
    case LinkedAccount = 'linked_account';
    // A place as the person wrote it (`text`).
    case Location = 'location';
    // Whether callers mark a phone number as spam (`flag`).
    case MarkedSpam = 'marked_spam';
    // A middle name (`person_name`).
    case MiddleName = 'middle_name';
    // A nationality (`country`).
    case Nationality = 'nationality';
    // An organisation the source names, such as a company (`organisation`).
    case Organisation = 'organisation';
    // An IP whose use the source does not say (`ip`).
    case OtherIp = 'other_ip';
    // Whether the account is paid or premium (`flag`).
    case Paid = 'paid';
    // When the password last changed (`date` or `date_time`).
    case PasswordChanged = 'password_changed';
    // The payment method or card brand the account paid with (`label`).
    case PaymentMethod = 'payment_method';
    // The profile picture (`image`).
    case Picture = 'picture';
    // Points on the site (`score`).
    case Points = 'points';
    // How many posts the account made (`count`).
    case Posts = 'posts';
    // Whether the account is private (`flag`).
    case Private = 'private';
    // The link to the profile (`url`).
    case ProfileLink = 'profile_link';
    // How many times people viewed the profile (`count`).
    case ProfileViews = 'profile_views';
    // A rating of the account (`score`).
    case Rating = 'rating';
    // How many people the account referred (`count`).
    case Referrals = 'referrals';
    // Who or what referred the account (`text`).
    case Referrer = 'referrer';
    // How many reports callers made on a phone number (`count`).
    case ReportCount = 'report_count';
    // Reputation on the site (`score`).
    case Reputation = 'reputation';
    // A reputation label for a phone number (`label`).
    case ReputationLabel = 'reputation_label';
    // The country the person lives in (`country`).
    case Residence = 'residence';
    // A salutation or suffix, such as Dr or Jr (`text`).
    case Salutation = 'salutation';
    // A school the source names (`organisation`).
    case School = 'school';
    // A signature the person posts under (`long_text`).
    case Signature = 'signature';
    // The IP the account was made from (`ip`).
    case SignupIp = 'signup_ip';
    // A role on the site, such as admin or moderator (`label`).
    case SiteRole = 'site_role';
    // How likely a phone number is spam, as the source scores it (`score`).
    case SpamScore = 'spam_score';
    // A street line of an address (`address`).
    case Street = 'street';
    // How many trades a forum account completed (`count`).
    case Trades = 'trades';
    // Whether the site verified the account (`flag`).
    case Verified = 'verified';
    // Warnings and infractions on the account (`count`).
    case Warnings = 'warnings';
    // A website the person lists (`url`).
    case Website = 'website';
}
