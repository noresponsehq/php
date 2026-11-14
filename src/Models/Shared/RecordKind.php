<?php

declare(strict_types=1);

namespace NoResponse\Models\Shared;


/** What sort of value a field holds, which decides how it is cleaned, compared and searched again. It comes from the value itself where its shape is certain (an email, an IP, a URL, an international phone number), else from the answer stored for the source's column, else text. A value of any kind is returned. */
enum RecordKind: string
{
    case Email = 'email';
    case Phone = 'phone';
    case Username = 'username';
    case AccountId = 'account_id';
    case Url = 'url';
    case Domain = 'domain';
    case Image = 'image';
    case PersonName = 'person_name';
    case Gender = 'gender';
    case Age = 'age';
    case Language = 'language';
    case Organisation = 'organisation';
    case JobTitle = 'job_title';
    case Country = 'country';
    case Region = 'region';
    case City = 'city';
    case Address = 'address';
    case Postcode = 'postcode';
    case Coordinates = 'coordinates';
    case Timezone = 'timezone';
    case Date = 'date';
    case DateTime = 'date_time';
    case Duration = 'duration';
    case Ip = 'ip';
    case MacAddress = 'mac_address';
    case DeviceId = 'device_id';
    case UserAgent = 'user_agent';
    case Password = 'password';
    case Hash = 'hash';
    case Salt = 'salt';
    case Token = 'token';
    case SecurityAnswer = 'security_answer';
    case CardNumber = 'card_number';
    case BankAccount = 'bank_account';
    case CryptoAddress = 'crypto_address';
    case Amount = 'amount';
    case IdNumber = 'id_number';
    case Vehicle = 'vehicle';
    case Label = 'label';
    case LongText = 'long_text';
    case Count = 'count';
    case Score = 'score';
    case Flag = 'flag';
    case Structured = 'structured';
    case Text = 'text';
}
