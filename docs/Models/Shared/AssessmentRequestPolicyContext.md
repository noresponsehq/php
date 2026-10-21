# AssessmentRequestPolicyContext


## Fields

| Field                                                                   | Type                                                                    | Required                                                                | Description                                                             |
| ----------------------------------------------------------------------- | ----------------------------------------------------------------------- | ----------------------------------------------------------------------- | ----------------------------------------------------------------------- |
| `flow`                                                                  | [?Shared\Flow](../../Models/Shared/Flow.md)                             | :heavy_minus_sign:                                                      | The provider flow the assessment gates. Absent means signup.            |
| `region`                                                                | *?string*                                                               | :heavy_minus_sign:                                                      | ISO 3166-1 alpha-2 region of the signup, as the provider determines it. |