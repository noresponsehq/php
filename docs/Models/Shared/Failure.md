# Failure

Why the attempt failed: the URL is no longer valid, the host did not resolve, it resolved to an address that is not public, no answer within 5 seconds, the connection failed, a 3xx (redirects are not followed) or another non-2xx status. Absent for a delivered attempt.


## Values

| Name               | Value              |
| ------------------ | ------------------ |
| `InvalidUrl`       | invalid_url        |
| `ResolveFailed`    | resolve_failed     |
| `AddressRefused`   | address_refused    |
| `Timeout`          | timeout            |
| `ConnectionFailed` | connection_failed  |
| `Redirect`         | redirect           |
| `Non2xx`           | non_2xx            |