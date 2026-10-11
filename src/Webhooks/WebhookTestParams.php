<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Send a test event to a webhook for testing and debugging purposes.
 *
 * @see EInvoiceAPI\Services\WebhooksService::test()
 *
 * @phpstan-type WebhookTestParamsShape = array{
 *   data: array<string,mixed>, eventType: string
 * }
 */
final class WebhookTestParams implements BaseModel
{
    /** @use SdkModel<WebhookTestParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Custom event data payload.
     *
     * @var array<string,mixed> $data
     */
    #[Required(map: 'mixed')]
    public array $data;

    /**
     * Must be valid WebhookEventType.
     */
    #[Required('event_type')]
    public string $eventType;

    /**
     * `new WebhookTestParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestParams::with(data: ..., eventType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestParams)->withData(...)->withEventType(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param array<string,mixed> $data
     */
    public static function with(array $data, string $eventType): self
    {
        $self = new self;

        $self['data'] = $data;
        $self['eventType'] = $eventType;

        return $self;
    }

    /**
     * Custom event data payload.
     *
     * @param array<string,mixed> $data
     */
    public function withData(array $data): self
    {
        $self = clone $this;
        $self['data'] = $data;

        return $self;
    }

    /**
     * Must be valid WebhookEventType.
     */
    public function withEventType(string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }
}
