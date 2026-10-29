# MemberList

GET /v1/workspaces/{workspace_id}/members: the workspace's active members, oldest first, at most 100.


## Fields

| Field                                                 | Type                                                  | Required                                              | Description                                           |
| ----------------------------------------------------- | ----------------------------------------------------- | ----------------------------------------------------- | ----------------------------------------------------- |
| `items`                                               | array<[Shared\Member](../../Models/Shared/Member.md)> | :heavy_check_mark:                                    | N/A                                                   |