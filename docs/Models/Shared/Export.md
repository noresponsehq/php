# Export

Retained review snapshot.


## Fields

| Field                                                               | Type                                                                | Required                                                            | Description                                                         | Example                                                             |
| ------------------------------------------------------------------- | ------------------------------------------------------------------- | ------------------------------------------------------------------- | ------------------------------------------------------------------- | ------------------------------------------------------------------- |
| `exportedAt`                                                        | *string*                                                            | :heavy_check_mark:                                                  | N/A                                                                 | 2026-01-01T00:00:00Z                                                |
| `review`                                                            | [Shared\Review](../../Models/Shared/Review.md)                      | :heavy_check_mark:                                                  | N/A                                                                 |                                                                     |
| `comments`                                                          | array<[Shared\ReviewComment](../../Models/Shared/ReviewComment.md)> | :heavy_check_mark:                                                  | N/A                                                                 |                                                                     |
| `resolutions`                                                       | array<[Shared\Resolution](../../Models/Shared/Resolution.md)>       | :heavy_check_mark:                                                  | N/A                                                                 |                                                                     |
| `subjects`                                                          | array<[Shared\ReviewSubject](../../Models/Shared/ReviewSubject.md)> | :heavy_check_mark:                                                  | N/A                                                                 |                                                                     |