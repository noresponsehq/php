# RequestDiagnosticPage

Authenticated attempts in a bounded interval, newest first. Keep the same filters when paging.


## Fields

| Field                                                                       | Type                                                                        | Required                                                                    | Description                                                                 | Example                                                                     |
| --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- | --------------------------------------------------------------------------- |
| `items`                                                                     | array<[Shared\RequestDiagnostic](../../Models/Shared/RequestDiagnostic.md)> | :heavy_check_mark:                                                          | N/A                                                                         |                                                                             |
| `nextCursor`                                                                | *?string*                                                                   | :heavy_minus_sign:                                                          | N/A                                                                         | eyJ0IjoxNzY3MjI1NjAwMDAwMDAwLCJpIjoiYXNtX2V4YW1wbGUiLCJlIjoxNzY3MjI5MjAwfQ  |