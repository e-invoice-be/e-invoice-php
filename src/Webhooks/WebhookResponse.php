<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Response model for webhook API endpoints.
 *
 * @phpstan-type WebhookResponseShape = array{
 *   id: string,
 *   events: list<string>,
 *   secret: string,
 *   url: string,
 *   enabled?: bool|null,
 * }
 */
final class WebhookResponse implements BaseModel
{
    /** @use SdkModel<WebhookResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var list<string> $events */
    #[Required(list: 'string')]
    public array $events;

    #[Required]
    public string $secret;

    #[Required]
    public string $url;

    #[Optional]
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
        $self = new self;

        $self['id'] = $id;
        $self['events'] = $events;
        $self['secret'] = $secret;
        $self['url'] = $url;

        null !== $enabled && $self['enabled'] = $enabled;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

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

    public function withSecret(string $secret): self
    {
        $self = clone $this;
        $self['secret'] = $secret;

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
