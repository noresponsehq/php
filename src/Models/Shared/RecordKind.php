<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What sort of value a field holds, which decides how it is cleaned, compared and searched again. It comes from the value itself where its shape is certain (an email, an IP, a URL, an international phone number), else from the answer stored for the source's column, else text. A value of any kind is returned. Each kind's description says what it holds and the form value takes. */
enum RecordKind: string
{
    // An email address. value: in lower case, without a mailto: prefix.
    case Email = 'email';
    // A phone number. value: in E.164 form, such as +447700900123. A national number is cleaned only when the country of the source's site is known.
    case Phone = 'phone';
    // A handle a person chose. value: as written. Compare it in lower case. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case Username = 'username';
    // A platform's own id for an account. value: as written. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case AccountId = 'account_id';
    // A web address. value: the scheme and host in lower case, the path, query and fragment as written.
    case Url = 'url';
    // A host name with no path. value: in lower case, also when the source wrote a URL.
    case Domain = 'domain';
    // A picture, as a link or a file. value: the link, cleaned as a `url`.
    case Image = 'image';
    // A whole name or a part of one. value: with each run of spaces made one space.
    case PersonName = 'person_name';
    // A stated gender. value: `female`, `male` or `other` when the value names one of them, else as written.
    case Gender = 'gender';
    // An age in years. value: a whole number from 0 to 150.
    case Age = 'age';
    // A language. value: its ISO 639 code, two letters when the language has them.
    case Language = 'language';
    // A company, school or group by name. value: with each run of spaces made one space.
    case Organisation = 'organisation';
    // A position or occupation. value: as written.
    case JobTitle = 'job_title';
    // A country. value: its ISO 3166-1 alpha-2 code, such as GB.
    case Country = 'country';
    // A state, province or county. value: as written.
    case Region = 'region';
    // A city or town. value: as written.
    case City = 'city';
    // A street address or one line of it. value: as written. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case Address = 'address';
    // A postal code. value: in upper case with single spaces.
    case Postcode = 'postcode';
    // A latitude and longitude. value: `latitude,longitude` in decimal degrees.
    case Coordinates = 'coordinates';
    // A timezone or an offset. value: an IANA zone name, UTC, or an offset such as +05:30.
    case Timezone = 'timezone';
    // A calendar date. value: in ISO form at the precision the source gives: 2014, 2014-03 or 2014-03-07.
    case Date = 'date';
    // A moment. value: in ISO form in UTC, such as 2014-03-07T09:30:00Z, or a date when the source gives no time.
    case DateTime = 'date_time';
    // A length of time. value: a number of seconds.
    case Duration = 'duration';
    // An IPv4 or IPv6 address. value: its standard text form. An IPv4 address stored as a whole number is written as IPv4.
    case Ip = 'ip';
    // A network card address. value: in lower case with colons.
    case MacAddress = 'mac_address';
    // An id of a phone, computer or browser. value: as written. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case DeviceId = 'device_id';
    // A browser or app signature. value: as written.
    case UserAgent = 'user_agent';
    // A password in plain text. value: exactly as written, spaces included.
    case Password = 'password';
    // A password hash. value: as written. detail names the likely algorithm, such as bcrypt.
    case Hash = 'hash';
    // The salt for a hash. value: exactly as written.
    case Salt = 'salt';
    // A session, reset or API token. value: as written. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case Token = 'token';
    // A security question or its answer. value: exactly as written.
    case SecurityAnswer = 'security_answer';
    // A payment card number. value: its 12 to 19 digits only.
    case CardNumber = 'card_number';
    // An IBAN or account number. value: its letters and digits only, in upper case.
    case BankAccount = 'bank_account';
    // A wallet address. value: as written. detail names the likely coin, such as BTC.
    case CryptoAddress = 'crypto_address';
    // Money, with its currency when given. value: a plain decimal. detail names the currency, such as USD.
    case Amount = 'amount';
    // A passport, tax, national or licence number. value: as written. A value that is only zeros, or null, nil, none, undefined or n/a, has no value.
    case IdNumber = 'id_number';
    // A number plate or a VIN. value: in upper case with no spaces.
    case Vehicle = 'vehicle';
    // One of a small set, such as a status or level. value: as written.
    case Label = 'label';
    // Free writing, such as a bio or signature. value: as written.
    case LongText = 'long_text';
    // A whole number of things. value: a whole number with no thousands separators.
    case Count = 'count';
    // A rating, rank or points. value: a plain decimal.
    case Score = 'score';
    // A yes or no. value: `true` or `false`.
    case Flag = 'flag';
    // A nested value that could not be split. value: as written.
    case Structured = 'structured';
    // Anything else. value: as written.
    case Text = 'text';
}
