<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Response model for webhook API endpoints.
 *
 * @phpstan-type webhook_response = array{
 *   id: string, events: list<string>, secret: string, url: string, enabled?: bool
 * }
 * When used in a response, this type parameter can be used to define a $rawResponse property.
 * @template TRawResponse of object = object{}
 *
 * @mixin TRawResponse
 */
final class WebhookResponse implements BaseModel
{
    /** @use SdkModel<webhook_response> */
    use SdkModel;

    #[Api]
    public string $id;

    /** @var list<string> $events */
    #[Api(list: 'string')]
    public array $events;

    #[Api]
    public string $secret;

    #[Api]
    public string $url;

    #[Api(optional: true)]
    public ?bool $enabled;

    /**
     * `new WebhookResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookResponse::with(id: ..., events: ..., secret: ..., url: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookResponse)
     *   ->withID(...)
     *   ->withEvents(...)
     *   ->withSecret(...)
     *   ->withURL(...)
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
        string $id,
        array $events,
        string $secret,
        string $url,
        ?bool $enabled = null
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->events = $events;
        $obj->secret = $secret;
        $obj->url = $url;

        null !== $enabled && $obj->enabled = $enabled;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

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

    public function withSecret(string $secret): self
    {
        $obj = clone $this;
        $obj->secret = $secret;

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
