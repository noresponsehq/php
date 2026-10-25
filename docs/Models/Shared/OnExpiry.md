# OnExpiry

The decision a held assessment takes when hold_seconds pass before its investigation completes, unless the evidence so far gives a stricter one (default review). It is announced as account.risk_changed like any other change, so an expired hold is always announced. A hosted provider hook, which cannot wait, answers a held account by it at once: deny for block, allow otherwise. Kept while the flow is immediate.


## Values

| Name     | Value    |
| -------- | -------- |
| `Allow`  | allow    |
| `Review` | review   |
| `Block`  | block    |