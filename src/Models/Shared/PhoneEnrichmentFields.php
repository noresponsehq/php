<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class PhoneEnrichmentFields
{
    /**
     *
     * @var ?string $phone
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('phone')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $phone = null;

    /**
     *
     * @var ?string $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $name = null;

    /**
     *
     * @var ?string $carrier
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('carrier')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $carrier = null;

    /**
     *
     * @var ?string $lineType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('line_type')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lineType = null;

    /**
     *
     * @var ?string $entityType
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('entity_type')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $entityType = null;

    /**
     *
     * @var ?string $countryCode
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country_code')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $countryCode = null;

    /**
     *
     * @var ?string $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $country = null;

    /**
     *
     * @var ?string $state
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('state')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $state = null;

    /**
     *
     * @var ?string $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $city = null;

    /**
     *
     * @var ?string $location
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('location')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $location = null;

    /**
     *
     * @var ?string $nationalFormat
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('national_format')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $nationalFormat = null;

    /**
     *
     * @var ?string $jobTitle
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('job_title')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $jobTitle = null;

    /**
     *
     * @var ?string $companyName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company_name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $companyName = null;

    /**
     *
     * @var ?string $email
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('email')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $email = null;

    /**
     *
     * @var ?string $website
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('website')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $website = null;

    /**
     *
     * @var ?string $firstCallAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('first_call_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $firstCallAt = null;

    /**
     *
     * @var ?string $lastCallAt
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('last_call_at')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $lastCallAt = null;

    /**
     *
     * @var ?string $matchedName
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('matched_name')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?string $matchedName = null;

    /**
     * $alternateNames
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\AlternateName|array<mixed>> $alternateNames
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('alternate_names')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\AlternateName|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $alternateNames = null;

    /**
     * $nameCandidates
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\NameCandidate|array<mixed>> $nameCandidates
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name_candidates')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\NameCandidate|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $nameCandidates = null;

    /**
     * $timezones
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Timezone|array<mixed>> $timezones
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('timezones')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Timezone|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $timezones = null;

    /**
     * $emails
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Email|array<mixed>> $emails
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('emails')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Email|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $emails = null;

    /**
     * $websites
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Website|array<mixed>> $websites
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('websites')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Website|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $websites = null;

    /**
     * $locations
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\Location|array<mixed>> $locations
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('locations')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\Location|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $locations = null;

    /**
     * $socialProfiles
     *
     * @var ?array<string|float|bool|\NoResponse\Models\Shared\SocialProfile|array<mixed>> $socialProfiles
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('social_profiles')]
    #[\NoResponse\Serializer\Annotation\Type('array<string|float|bool|\NoResponse\Models\Shared\SocialProfile|array<mixed>>|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?array $socialProfiles = null;

    /**
     *
     * @var ?int $reportCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('report_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $reportCount = null;

    /**
     *
     * @var ?int $tagCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('tag_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $tagCount = null;

    /**
     *
     * @var ?int $totalCalls
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('total_calls')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $totalCalls = null;

    /**
     *
     * @var ?int $calls60Days
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('calls_60_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $calls60Days = null;

    /**
     *
     * @var ?int $reports60Days
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('reports_60_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $reports60Days = null;

    /**
     *
     * @var ?int $searches60Days
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('searches_60_days')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $searches60Days = null;

    /**
     *
     * @var ?int $commentCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('comment_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $commentCount = null;

    /**
     *
     * @var ?int $namesCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('names_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?int $namesCount = null;

    /**
     *
     * @var ?int $spamReportCount
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('spam_report_count')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
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