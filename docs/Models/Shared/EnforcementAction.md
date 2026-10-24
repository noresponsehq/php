# EnforcementAction

What the workspace did in its identity provider: revoke_sessions (signed the account out everywhere), restrict (limited what the account can do), unrestrict (lifted an earlier restriction), fail_onboarding (stopped an account that was still onboarding), reject_activation (refused to activate a provisional account) or none (decided to take no action).


## Values

| Name               | Value              |
| ------------------ | ------------------ |
| `RevokeSessions`   | revoke_sessions    |
| `Restrict`         | restrict           |
| `Unrestrict`       | unrestrict         |
| `FailOnboarding`   | fail_onboarding    |
| `RejectActivation` | reject_activation  |
| `None`             | none               |