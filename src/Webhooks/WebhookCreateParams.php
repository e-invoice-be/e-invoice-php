<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Create a new webhook.
 *
 * @see EInvoiceAPI\Webhooks->create
 *
 * @phpstan-type webhook_create_params = array{
 *   events: list<string>, url: string, enabled?: bool
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    /** @use SdkModel<webhook_create_params> */
    use SdkModel;
    use SdkParams;

    /** @var list<string> $events */
    #[Api(list: 'string')]
    public array $events;

    #[Api]
    public string $url;

    #[Api(optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        $obj = new self;

        $obj->events = $events;
        $obj->url = $url;

        null !== $enabled && $obj->enabled = $enabled;

        return $obj;
    }

    /**
     * @param list<string> $events
     */
    public function withEvents(array $events): self
    {
        $obj = clone $this;
        $obj->events = $events;

        return $obj;
    }

    public function withURL(string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }

    public function withEnabled(bool $enabled): self
    {
        $obj = clone $this;
        $obj->enabled = $enabled;

        return $obj;
    }
}
