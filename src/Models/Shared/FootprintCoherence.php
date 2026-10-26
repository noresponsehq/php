<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


class FootprintCoherence
{
    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $birthDate
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('birth_date')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $birthDate = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $gender
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('gender')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $gender = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $nationality
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('nationality')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $nationality = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $country
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('country')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $country = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $city
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('city')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $city = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $zip
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('zip')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $zip = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $name
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('name')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $name = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $company
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('company')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $company = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $website
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('website')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $website = null;

    /**
     * How far independent sources agree on one attribute: values is the number of distinct values reported, support the tables and profiles reporting any, and agreement match (one value), partial (the most reported value holds more than half the support) or mismatch. The values themselves are not served.
     *
     * @var ?\NoResponse\Models\Shared\AttributeAgreement $social
     */
    #[\NoResponse\Serializer\Annotation\SerializedName('social')]
    #[\NoResponse\Serializer\Annotation\Type('\NoResponse\Models\Shared\AttributeAgreement|null')]
    #[\NoResponse\Serializer\Annotation\SkipWhenNull]
    public ?AttributeAgreement $social = null;

    /**
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $birthDate
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $gender
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $nationality
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $country
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $city
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $zip
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $name
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $company
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $website
     * @param  ?\NoResponse\Models\Shared\AttributeAgreement  $social
     * @phpstan-pure
     */
    public function __construct(?AttributeAgreement $birthDate = null, ?AttributeAgreement $gender = null, ?AttributeAgreement $nationality = null, ?AttributeAgreement $country = null, ?AttributeAgreement $city = null, ?AttributeAgreement $zip = null, ?AttributeAgreement $name = null, ?AttributeAgreement $company = null, ?AttributeAgreement $website = null, ?AttributeAgreement $social = null)
    {
        $this->birthDate = $birthDate;
        $this->gender = $gender;
        $this->nationality = $nationality;
        $this->country = $country;
        $this->city = $city;
        $this->zip = $zip;
        $this->name = $name;
        $this->company = $company;
        $this->website = $website;
        $this->social = $social;
    }
}