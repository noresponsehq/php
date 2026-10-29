<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListReviewCommentsResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\ReviewCommentList $result
     */
    #[NoResponseMetadata('')]
    public Shared\ReviewCommentList $result;

    /**
     * @var \Closure(string): ?ListReviewCommentsResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\ReviewCommentList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\ReviewCommentList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListReviewCommentsResponse
     */
    public function __call($name, $args): ?ListReviewCommentsResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}