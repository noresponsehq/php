# PolicyRestoreRequest

Publish a captured configuration as a new version. Version checks and publication are atomic. Longer retention does not revive expired records, and restored policy does not undo customer enforcement.


## Fields

| Field                                               | Type                                                | Required                                            | Description                                         | Example                                             |
| --------------------------------------------------- | --------------------------------------------------- | --------------------------------------------------- | --------------------------------------------------- | --------------------------------------------------- |
| `version`                                           | *int*                                               | :heavy_check_mark:                                  | N/A                                                 |                                                     |
| `expectedPolicyVersion`                             | *int*                                               | :heavy_check_mark:                                  | N/A                                                 |                                                     |
| `changeReason`                                      | *string*                                            | :heavy_check_mark:                                  | N/A                                                 | Adjust thresholds after reviewing retained evidence |