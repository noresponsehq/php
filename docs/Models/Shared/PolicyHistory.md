# PolicyHistory

Immutable settings snapshots, newest first. history_complete is false when earlier versions predate capture. A restored version is published with a fresh version number. History is removed with the tenant.


## Fields

| Field                                                                       | Type                                                                        | Required                                                                    | Description                                                                 |
| --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- |
| `items`                                                                     | array<[Shared\PolicyHistoryItem](../../Models/Shared/PolicyHistoryItem.md)> | :heavy_check_mark:                                                          | N/A                                                                         |
| `hasMore`                                                                   | *bool*                                                                      | :heavy_check_mark:                                                          | N/A                                                                         |
| `nextBeforeVersion`                                                         | *?int*                                                                      | :heavy_minus_sign:                                                          | N/A                                                                         |
| `historyComplete`                                                           | *bool*                                                                      | :heavy_check_mark:                                                          | N/A                                                                         |