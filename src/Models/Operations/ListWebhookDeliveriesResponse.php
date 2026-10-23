<?php

declare(strict_types=1);

namespace NoResponse\Models\Operations;

use NoResponse\Models\Shared;
use NoResponse\Utils\NoResponseMetadata;
class ListWebhookDeliveriesResponse
{
    /**
     * $headers
     *
     * @var array<string, array<string>> $headers
     */
    public array $headers;

    /**
     *
     * @var \NoResponse\Models\Shared\WebhookDeliveryList $result
     */
    #[NoResponseMetadata('')]
    public Shared\WebhookDeliveryList $result;

    /**
     * @var \Closure(string): ?ListWebhookDeliveriesResponse $next
     */
    public \Closure $next;
    /**
     * @param  array<string, array<string>>  $headers
     * @param  \NoResponse\Models\Shared\WebhookDeliveryList  $result
     * @phpstan-pure
     */
    public function __construct(Shared\WebhookDeliveryList $result, ?array $headers = [])
    {
        $this->headers = $headers;
        $this->result = $result;
    }
    /**
     * @param  string  $name
     * @param  array<mixed>  $args
     * @return ?ListWebhookDeliveriesResponse
     */
    public function __call($name, $args): ?ListWebhookDeliveriesResponse
    {
        if ($name === 'next') {
            return call_user_func_array($this->next, $args);
        }

        return null;
    }
}