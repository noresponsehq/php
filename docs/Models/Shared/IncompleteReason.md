# IncompleteReason

Why a lane did not settle. deferred means the lane is asynchronous and still running; a continuation settles it. timed_out means the lane missed its deadline. insufficient_evidence is a settled inconclusive signal rather than an incomplete lane.


## Values

| Name          | Value         |
| ------------- | ------------- |
| `TimedOut`    | timed_out     |
| `RateLimited` | rate_limited  |
| `Blocked`     | blocked       |
| `SourceError` | source_error  |
| `Unavailable` | unavailable   |
| `Deferred`    | deferred      |