# FailureReason

Why a signal or source did not produce a definite found/not_found. timed_out means the source missed the request deadline; a continuation may still settle it. deferred means the (source, identifier) pair is async-only and was not attempted on the synchronous path; a continuation settles it.


## Values

| Name                   | Value                  |
| ---------------------- | ---------------------- |
| `TimedOut`             | timed_out              |
| `RateLimited`          | rate_limited           |
| `Blocked`              | blocked                |
| `SourceError`          | source_error           |
| `Unavailable`          | unavailable            |
| `Deferred`             | deferred               |
| `InsufficientEvidence` | insufficient_evidence  |