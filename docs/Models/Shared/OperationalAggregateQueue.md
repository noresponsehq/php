# OperationalAggregateQueue

Current retained delivery queue, independent of the requested attempt window and status filter. Endpoint filter applies. Does not prove customer enforcement execution.


## Fields

| Field                | Type                 | Required             | Description          | Example              |
| -------------------- | -------------------- | -------------------- | -------------------- | -------------------- |
| `pending`            | *int*                | :heavy_check_mark:   | N/A                  |                      |
| `leased`             | *int*                | :heavy_check_mark:   | N/A                  |                      |
| `deadRetained`       | *int*                | :heavy_check_mark:   | N/A                  |                      |
| `oldestPendingAt`    | *?string*            | :heavy_minus_sign:   | N/A                  | 2026-01-01T00:00:00Z |