# Events

## Overview

Events, attendee lists, screenings and reviewer decisions.

### Available Operations

* [list](#list) - List an environment's events.
* [create](#create) - Create an event to screen.
* [get](#get) - Read an event.
* [update](#update) - Change an event.
* [delete](#delete) - Erase an event.
* [listAttendees](#listattendees) - List an event's attendees.
* [addAttendees](#addattendees) - Add or update a batch of attendees.
* [getAttendee](#getattendee) - Read an attendee's report.
* [reviewAttendee](#reviewattendee) - Record a decision on an attendee.
* [listScreenings](#listscreenings) - List an event's screenings.
* [startScreening](#startscreening) - Start a screening.
* [getScreening](#getscreening) - Read a screening.
* [cancelScreening](#cancelscreening) - Cancel a screening.

## list

List this environment's events, newest first. Pass next_before back as before for the next page. Requires the events scope.

### Example Usage

<!-- UsageSnippet language="php" operationID="listEvents" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->list(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    limit: 20

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `limit`                                                                                                                                                                | *?int*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                     | At most this many items.                                                                                                                                               |                                                                                                                                                                        |
| `before`                                                                                                                                                               | *?string*                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                     | Read events older than this one.                                                                                                                                       |                                                                                                                                                                        |

### Response

**[?Operations\ListEventsResponse](../../Models/Operations/ListEventsResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## create

Create an event to screen: its name, start, venue, host, the principals it protects and the sensitive topics posts are read against. An environment holds at most 1000 events.

### Example Usage

<!-- UsageSnippet language="php" operationID="createEvent" method="post" path="/v1/workspaces/{workspace_id}/events/{environment}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\EventRequest(
    name: 'Annual shareholder meeting',
    startsAt: '2026-01-01T00:00:00Z',
    endsAt: '2026-01-02T00:00:00Z',
    venue: 'Example Convention Centre',
    host: 'Example Holdings',
    principals: [
        new Shared\Principal(
            name: 'Alex Principal',
            aliases: [
                'Alex P',
            ],
        ),
    ],
    topics: [
        'executive pay',
    ],
);

$response = $sdk->events->create(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `body`                                                                                                                                                                 | [Shared\EventRequest](../../Models/Shared/EventRequest.md)                                                                                                             | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    |                                                                                                                                                                        |

### Response

**[?Operations\CreateEventResponse](../../Models/Operations/CreateEventResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## get

Read an event and how many attendees it holds.

### Example Usage

<!-- UsageSnippet language="php" operationID="getEvent" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->get(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |

### Response

**[?Operations\GetEventResponse](../../Models/Operations/GetEventResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## update

Change the fields you name. Send expected_version to apply the change only to that version.

### Example Usage

<!-- UsageSnippet language="php" operationID="updateEvent" method="patch" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\EventUpdate(
    name: 'Annual shareholder meeting',
    startsAt: '2026-01-01T00:00:00Z',
    endsAt: '2026-01-02T00:00:00Z',
    venue: 'Example Convention Centre',
    host: 'Example Holdings',
    principals: [
        new Shared\Principal(
            name: 'Alex Principal',
            aliases: [
                'Alex P',
            ],
        ),
    ],
    topics: [
        'executive pay',
    ],
);

$response = $sdk->events->update(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `body`                                                                                                                                                                 | [Shared\EventUpdate](../../Models/Shared/EventUpdate.md)                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    |                                                                                                                                                                        |

### Response

**[?Operations\UpdateEventResponse](../../Models/Operations/UpdateEventResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## delete

Erase an event with its attendees, their decisions and its screenings, and stop any screening still running.

### Example Usage

<!-- UsageSnippet language="php" operationID="deleteEvent" method="delete" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->delete(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM'

);

// The request completed successfully.
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |

### Response

**[?Operations\DeleteEventResponse](../../Models/Operations/DeleteEventResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## listAttendees

Read an event's roster in upload order, with each attendee's match state, highest finding band and decision. Filter by band or decision; pass next_after back as after.

### Example Usage

<!-- UsageSnippet language="php" operationID="listAttendees" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/attendees" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Operations;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$request = new Operations\ListAttendeesRequest(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
);

$response = $sdk->events->listAttendees(
    request: $request
);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                          | Type                                                                               | Required                                                                           | Description                                                                        |
| ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------- |
| `$request`                                                                         | [Operations\ListAttendeesRequest](../../Models/Operations/ListAttendeesRequest.md) | :heavy_check_mark:                                                                 | The request object to use for the request.                                         |

### Response

**[?Operations\ListAttendeesResponse](../../Models/Operations/ListAttendeesResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## addAttendees

Add or update 1 to 500 attendees with an Idempotency-Key. A row with the same external_id, else email, else phone as an existing attendee updates it. Identities are stored encrypted.

### Example Usage

<!-- UsageSnippet language="php" operationID="addAttendees" method="post" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/attendees" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\AttendeeBatchRequest(
    attendees: [
        new Shared\AttendeeIdentity(
            externalId: 'ticket-1042',
            name: 'Jordan Example',
            email: 'jordan@company-example.com',
            phone: '+14155550100',
            company: 'Example Ltd',
            city: 'Melbourne',
            handles: [
                new Shared\Handle(
                    platform: Shared\HandlePlatform::Tiktok,
                    handle: 'jordan_example',
                ),
            ],
        ),
    ],
);

$response = $sdk->events->addAttendees(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `workspaceId`                                                                                                                                                                                                                                                            | *string*                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                       | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                                                                                                                       | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                                                                                                                           |
| `environment`                                                                                                                                                                                                                                                            | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                                                                                                                   | :heavy_check_mark:                                                                                                                                                                                                                                                       | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404.                                                                                                   |                                                                                                                                                                                                                                                                          |
| `eventId`                                                                                                                                                                                                                                                                | *string*                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                                                                                                                           |
| `body`                                                                                                                                                                                                                                                                   | [Shared\AttendeeBatchRequest](../../Models/Shared/AttendeeBatchRequest.md)                                                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      |                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                       | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | account-acct_7f3a9c                                                                                                                                                                                                                                                      |

### Response

**[?Operations\AddAttendeesResponse](../../Models/Operations/AddAttendeesResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## getAttendee

Read an attendee's report: matched profiles, findings with their evidence and every recorded decision.

### Example Usage

<!-- UsageSnippet language="php" operationID="getAttendee" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/attendees/{attendee_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->getAttendee(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Test,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    attendeeId: 'att_01JA2Z8K6Q4V7W9XBCDEFGHJKM'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `attendeeId`                                                                                                                                                           | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | att_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |

### Response

**[?Operations\GetAttendeeResponse](../../Models/Operations/GetAttendeeResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## reviewAttendee

Record a cleared, watch or escalated decision with a note. The latest decision is the attendee's; the next screening refreshes everyone on watch or escalated.

### Example Usage

<!-- UsageSnippet language="php" operationID="reviewAttendee" method="post" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/attendees/{attendee_id}/review" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\AttendeeReviewRequest(
    decision: Shared\AttendeeDecision::Cleared,
    note: 'Known to the venue team.',
);

$response = $sdk->events->reviewAttendee(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    attendeeId: 'att_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `attendeeId`                                                                                                                                                           | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | att_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `body`                                                                                                                                                                 | [Shared\AttendeeReviewRequest](../../Models/Shared/AttendeeReviewRequest.md)                                                                                           | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    |                                                                                                                                                                        |

### Response

**[?Operations\ReviewAttendeeResponse](../../Models/Operations/ReviewAttendeeResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## listScreenings

List an event's screenings, newest first.

### Example Usage

<!-- UsageSnippet language="php" operationID="listScreenings" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/screenings" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->listScreenings(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    limit: 20

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `limit`                                                                                                                                                                | *?int*                                                                                                                                                                 | :heavy_minus_sign:                                                                                                                                                     | At most this many items.                                                                                                                                               |                                                                                                                                                                        |
| `before`                                                                                                                                                               | *?string*                                                                                                                                                              | :heavy_minus_sign:                                                                                                                                                     | Read screenings older than this one.                                                                                                                                   |                                                                                                                                                                        |

### Response

**[?Operations\ListScreeningsResponse](../../Models/Operations/ListScreeningsResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## startScreening

Start a screening of new attendees and everyone on watch or escalated, with an Idempotency-Key. It finishes completed, partial or failed minutes to hours later; poll it. The test environment screens with stand-ins that find no accounts.

### Example Usage

<!-- UsageSnippet language="php" operationID="startScreening" method="post" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/screenings" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\ScreeningRequest(
    depth: Shared\ScreeningDepth::Standard,
    platforms: [],
);

$response = $sdk->events->startScreening(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body,
    idempotencyKey: 'account-acct_7f3a9c'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                                                                                                                                | Type                                                                                                                                                                                                                                                                     | Required                                                                                                                                                                                                                                                                 | Description                                                                                                                                                                                                                                                              | Example                                                                                                                                                                                                                                                                  |
| ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ |
| `workspaceId`                                                                                                                                                                                                                                                            | *string*                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                       | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                                                                                                                       | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                                                                                                                           |
| `environment`                                                                                                                                                                                                                                                            | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                                                                                                                   | :heavy_check_mark:                                                                                                                                                                                                                                                       | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404.                                                                                                   |                                                                                                                                                                                                                                                                          |
| `eventId`                                                                                                                                                                                                                                                                | *string*                                                                                                                                                                                                                                                                 | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                                                                                                                           |
| `body`                                                                                                                                                                                                                                                                   | [Shared\ScreeningRequest](../../Models/Shared/ScreeningRequest.md)                                                                                                                                                                                                       | :heavy_check_mark:                                                                                                                                                                                                                                                       | N/A                                                                                                                                                                                                                                                                      |                                                                                                                                                                                                                                                                          |
| `idempotencyKey`                                                                                                                                                                                                                                                         | *?string*                                                                                                                                                                                                                                                                | :heavy_minus_sign:                                                                                                                                                                                                                                                       | Opaque client key, 16 to 128 characters of [A-Za-z0-9._:-] (a UUID or ULID fits). Scoped to the workspace principal and bound to the canonical body for 24 hours. Optional: the SDK generates a UUID when you omit it and sends the same key on every retry of the call. | account-acct_7f3a9c                                                                                                                                                                                                                                                      |

### Response

**[?Operations\StartScreeningResponse](../../Models/Operations/StartScreeningResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## getScreening

Read a screening's status and progress.

### Example Usage

<!-- UsageSnippet language="php" operationID="getScreening" method="get" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/screenings/{screening_id}" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();



$response = $sdk->events->getScreening(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    screeningId: 'scn_01JA2Z8K6Q4V7W9XBCDEFGHJKM'

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `screeningId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | scn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |

### Response

**[?Operations\GetScreeningResponse](../../Models/Operations/GetScreeningResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |

## cancelScreening

Stop a queued or running screening. Attendees already screened keep their results.

### Example Usage

<!-- UsageSnippet language="php" operationID="cancelScreening" method="post" path="/v1/workspaces/{workspace_id}/events/{environment}/{event_id}/screenings/{screening_id}/cancel" -->
```php
declare(strict_types=1);

require 'vendor/autoload.php';

use NoResponse;
use NoResponse\Models\Shared;

$sdk = NoResponse\NoResponseClient::builder()
    ->setSecurity(
        getenv('NORESPONSE_API_KEY') ?: ''
    )
    ->build();

$body = new Shared\ScreeningCancelRequest();

$response = $sdk->events->cancelScreening(
    workspaceId: 'tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    environment: Shared\KeyEnvironment::Live,
    eventId: 'evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    screeningId: 'scn_01JA2Z8K6Q4V7W9XBCDEFGHJKM',
    body: $body

);

$result = $response->result;
// handle response
```

### Parameters

| Parameter                                                                                                                                                              | Type                                                                                                                                                                   | Required                                                                                                                                                               | Description                                                                                                                                                            | Example                                                                                                                                                                |
| ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- | ---------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `workspaceId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | Your workspace id, as each key lists it in workspace_id. Another workspace, a malformed id and a test environment's id answer 404.                                     | tnt_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `environment`                                                                                                                                                          | [Shared\KeyEnvironment\|string](../../Models/Shared/KeyEnvironment.md)                                                                                                 | :heavy_check_mark:                                                                                                                                                     | The environment: live or test. Each has its own settings. Any other value answers 400. An API key reads and changes only its own environment's; the other answers 404. |                                                                                                                                                                        |
| `eventId`                                                                                                                                                              | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | evn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `screeningId`                                                                                                                                                          | *string*                                                                                                                                                               | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    | scn_01JA2Z8K6Q4V7W9XBCDEFGHJKM                                                                                                                                         |
| `body`                                                                                                                                                                 | [Shared\ScreeningCancelRequest](../../Models/Shared/ScreeningCancelRequest.md)                                                                                         | :heavy_check_mark:                                                                                                                                                     | N/A                                                                                                                                                                    |                                                                                                                                                                        |

### Response

**[?Operations\CancelScreeningResponse](../../Models/Operations/CancelScreeningResponse.md)**

### Errors

| Error Type                   | Status Code                  | Content Type                 |
| ---------------------------- | ---------------------------- | ---------------------------- |
| Errors\BadRequestError       | 400                          | application/problem+json     |
| Errors\AuthenticationError   | 401                          | application/problem+json     |
| Errors\PermissionDeniedError | 403                          | application/problem+json     |
| Errors\NotFoundError         | 404                          | application/problem+json     |
| Errors\ConflictError         | 409                          | application/problem+json     |
| Errors\RateLimitError        | 429                          | application/problem+json     |
| Errors\APIStatusException    | 4XX, 5XX                     | \*/\*                        |