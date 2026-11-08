# AttendeeReport

Everything known about one attendee.


## Fields

| Field                                                                 | Type                                                                  | Required                                                              | Description                                                           |
| --------------------------------------------------------------------- | --------------------------------------------------------------------- | --------------------------------------------------------------------- | --------------------------------------------------------------------- |
| `attendee`                                                            | [Shared\Attendee](../../Models/Shared/Attendee.md)                    | :heavy_check_mark:                                                    | An attendee and where their screening and review stand.               |
| `profiles`                                                            | array<[Shared\Profile](../../Models/Shared/Profile.md)>               | :heavy_check_mark:                                                    | The accounts the screening matched, with how each was matched.        |
| `findings`                                                            | array<[Shared\Finding](../../Models/Shared/Finding.md)>               | :heavy_check_mark:                                                    | What the screening flagged, with its evidence.                        |
| `reviews`                                                             | array<[Shared\AttendeeReview](../../Models/Shared/AttendeeReview.md)> | :heavy_check_mark:                                                    | Every recorded decision, oldest first.                                |