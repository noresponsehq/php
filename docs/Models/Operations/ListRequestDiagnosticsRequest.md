# ListRequestDiagnosticsRequest


## Fields

| Field                                             | Type                                              | Required                                          | Description                                       | Example                                           |
| ------------------------------------------------- | ------------------------------------------------- | ------------------------------------------------- | ------------------------------------------------- | ------------------------------------------------- |
| `from`                                            | *string*                                          | :heavy_check_mark:                                | Inclusive start of a range of at most seven days. | 2026-10-21T00:00:00Z                              |
| `to`                                              | *string*                                          | :heavy_check_mark:                                | Exclusive end of the range.                       | 2026-10-22T00:00:00Z                              |
| `requestId`                                       | *?string*                                         | :heavy_minus_sign:                                | Optional filter or paging parameter.              |                                                   |
| `route`                                           | *?string*                                         | :heavy_minus_sign:                                | Optional filter or paging parameter.              |                                                   |
| `status`                                          | *?int*                                            | :heavy_minus_sign:                                | Optional filter or paging parameter.              |                                                   |
| `limit`                                           | *?int*                                            | :heavy_minus_sign:                                | Optional filter or paging parameter.              |                                                   |
| `cursor`                                          | *?string*                                         | :heavy_minus_sign:                                | Optional filter or paging parameter.              |                                                   |