<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Create a new webhook.
 *
 * @see EInvoiceAPI\Services\WebhooksService::create()
 *
 * @phpstan-type WebhookCreateParamsShape = array{
 *   events: list<string>, url: string, enabled?: bool
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<WebhookCreateParamsShape> */
    use SdkModel;
    use SdkParams;

    /** @var list<string> $events */
    #[Required(list: 'string')]
    public array $events;

    #[Required]
    public string $url;

    #[Optional]
    public ?bool $enabled;

    /**
     * `new WebhookCreateParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookCreateParams::with(events: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookCreateParams)->withEvents(...)->withURL(...)
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
     * @param list<string> $events
     */
    public static function with(
        array $events,
        string $url,
        ?bool $enabled = null
    ): self {
        $self = new self;

        $self['events'] = $events;
        $self['url'] = $url;

        null !== $enabled && $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * @param list<string> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    public function withURL(string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }

    public function withEnabled(bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }
}
