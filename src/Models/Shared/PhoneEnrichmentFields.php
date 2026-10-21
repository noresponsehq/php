<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PhoneEnrichmentFields
{
    /**
     *
     * @var ?string $phone
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('phone')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     *
     * @var ?string $name
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('name')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     *
     * @var ?string $carrier
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('carrier')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $carrier = null;

    /**
     *
     * @var ?string $lineType
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('line_type')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $lineType = null;

    /**
     *
     * @var ?string $entityType
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('entity_type')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $entityType = null;

    /**
     *
     * @var ?string $countryCode
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('country_code')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $countryCode = null;

    /**
     *
     * @var ?string $country
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('country')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     *
     * @var ?string $state
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('state')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $state = null;

    /**
     *
     * @var ?string $city
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('city')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     *
     * @var ?string $location
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('location')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $location = null;

    /**
     *
     * @var ?string $nationalFormat
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('national_format')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $nationalFormat = null;

    /**
     *
     * @var ?string $jobTitle
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('job_title')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $jobTitle = null;

    /**
     *
     * @var ?string $companyName
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('company_name')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $companyName = null;

    /**
     *
     * @var ?string $email
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('email')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     *
     * @var ?string $website
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('website')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $website = null;

    /**
     *
     * @var ?string $firstCallAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('first_call_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $firstCallAt = null;

    /**
     *
     * @var ?string $lastCallAt
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('last_call_at')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $lastCallAt = null;

    /**
     *
     * @var ?string $matchedName
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('matched_name')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?string $matchedName = null;

    /**
     * $alternateNames
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\AlternateName|array<mixed>> $alternateNames
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('alternate_names')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\AlternateName|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $alternateNames = null;

    /**
     * $nameCandidates
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\NameCandidate|array<mixed>> $nameCandidates
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('name_candidates')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\NameCandidate|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $nameCandidates = null;

    /**
     * $timezones
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Timezone|array<mixed>> $timezones
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('timezones')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Timezone|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $timezones = null;

    /**
     * $emails
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Email|array<mixed>> $emails
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('emails')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Email|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $emails = null;

    /**
     * $websites
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Website|array<mixed>> $websites
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('websites')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Website|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $websites = null;

    /**
     * $locations
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Location|array<mixed>> $locations
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('locations')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Location|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $locations = null;

    /**
     * $socialProfiles
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\SocialProfile|array<mixed>> $socialProfiles
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('social_profiles')]
    #[\Speakeasy\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\SocialProfile|array<mixed>>|null')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?array $socialProfiles = null;

    /**
     *
     * @var ?int $reportCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('report_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $reportCount = null;

    /**
     *
     * @var ?int $tagCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('tag_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $tagCount = null;

    /**
     *
     * @var ?int $totalCalls
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('total_calls')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $totalCalls = null;

    /**
     *
     * @var ?int $calls60Days
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('calls_60_days')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $calls60Days = null;

    /**
     *
     * @var ?int $reports60Days
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('reports_60_days')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $reports60Days = null;

    /**
     *
     * @var ?int $searches60Days
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('searches_60_days')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $searches60Days = null;

    /**
     *
     * @var ?int $commentCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('comment_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $commentCount = null;

    /**
     *
     * @var ?int $namesCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('names_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $namesCount = null;

    /**
     *
     * @var ?int $spamReportCount
     */
    #[\Speakeasy\Serializer\Annotation\SerializedName('spam_report_count')]
    #[\Speakeasy\Serializer\Annotation\SkipWhenNull]
    public ?int $spamReportCount = null;

    /**
     * @param  ?string  $phone
     * @param  ?string  $name
     * @param  ?string  $carrier
     * @param  ?string  $lineType
     * @param  ?string  $entityType
     * @param  ?string  $countryCode
     * @param  ?string  $country
     * @param  ?string  $state
     * @param  ?string  $city
     * @param  ?string  $location
     * @param  ?string  $nationalFormat
     * @param  ?string  $jobTitle
     * @param  ?string  $companyName
     * @param  ?string  $email
     * @param  ?string  $website
     * @param  ?string  $firstCallAt
     * @param  ?string  $lastCallAt
     * @param  ?string  $matchedName
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\AlternateName|array<mixed>>  $alternateNames
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\NameCandidate|array<mixed>>  $nameCandidates
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\Timezone|array<mixed>>  $timezones
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\Email|array<mixed>>  $emails
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\Website|array<mixed>>  $websites
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\Location|array<mixed>>  $locations
     * @param  ?array<string|float|bool|\NoResponse\Models\Shared\SocialProfile|array<mixed>>  $socialProfiles
     * @param  ?int  $reportCount
     * @param  ?int  $tagCount
     * @param  ?int  $totalCalls
     * @param  ?int  $calls60Days
     * @param  ?int  $reports60Days
     * @param  ?int  $searches60Days
     * @param  ?int  $commentCount
     * @param  ?int  $namesCount
     * @param  ?int  $spamReportCount
     * @phpstan-pure
     */
    public function __construct(?string $phone = null, ?string $name = null, ?string $carrier = null, ?string $lineType = null, ?string $entityType = null, ?string $countryCode = null, ?string $country = null, ?string $state = null, ?string $city = null, ?string $location = null, ?string $nationalFormat = null, ?string $jobTitle = null, ?string $companyName = null, ?string $email = null, ?string $website = null, ?string $firstCallAt = null, ?string $lastCallAt = null, ?string $matchedName = null, ?array $alternateNames = null, ?array $nameCandidates = null, ?array $timezones = null, ?array $emails = null, ?array $websites = null, ?array $locations = null, ?array $socialProfiles = null, ?int $reportCount = null, ?int $tagCount = null, ?int $totalCalls = null, ?int $calls60Days = null, ?int $reports60Days = null, ?int $searches60Days = null, ?int $commentCount = null, ?int $namesCount = null, ?int $spamReportCount = null)
    {
        $this->phone = $phone;
        $this->name = $name;
        $this->carrier = $carrier;
        $this->lineType = $lineType;
        $this->entityType = $entityType;
        $this->countryCode = $countryCode;
        $this->country = $country;
        $this->state = $state;
        $this->city = $city;
        $this->location = $location;
        $this->nationalFormat = $nationalFormat;
        $this->jobTitle = $jobTitle;
        $this->companyName = $companyName;
        $this->email = $email;
        $this->website = $website;
        $this->firstCallAt = $firstCallAt;
        $this->lastCallAt = $lastCallAt;
        $this->matchedName = $matchedName;
        $this->alternateNames = $alternateNames;
        $this->nameCandidates = $nameCandidates;
        $this->timezones = $timezones;
        $this->emails = $emails;
        $this->websites = $websites;
        $this->locations = $locations;
        $this->socialProfiles = $socialProfiles;
        $this->reportCount = $reportCount;
        $this->tagCount = $tagCount;
        $this->totalCalls = $totalCalls;
        $this->calls60Days = $calls60Days;
        $this->reports60Days = $reports60Days;
        $this->searches60Days = $searches60Days;
        $this->commentCount = $commentCount;
        $this->namesCount = $namesCount;
        $this->spamReportCount = $spamReportCount;
    }
}