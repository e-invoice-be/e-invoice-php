<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Update a webhook by ID.
 *
 * @see EInvoiceAPI\Services\WebhooksService::update()
 *
 * @phpstan-type WebhookUpdateParamsShape = array{
 *   enabled?: bool|null, events?: list<string>|null, url?: string|null
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    /** @use SdkModel<WebhookUpdateParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?bool $enabled;

    /** @var list<string>|null $events */
    #[Optional(list: 'string', nullable: true)]
    public ?array $events;

    #[Optional(nullable: true)]
    public ?string $url;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<string>|null $events
     */
    public static function with(
        ?bool $enabled = null,
        ?array $events = null,
        ?string $url = null
    ): self {
        $self = new self;

        null !== $enabled && $self['enabled'] = $enabled;
        null !== $events && $self['events'] = $events;
        null !== $url && $self['url'] = $url;

        return $self;
    }

    public function withEnabled(?bool $enabled): self
    {
        $self = clone $this;
        $self['enabled'] = $enabled;

        return $self;
    }

    /**
     * @param list<string>|null $events
     */
    public function withEvents(?array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }

    public function withURL(?string $url): self
    {
        $self = clone $this;
        $self['url'] = $url;

        return $self;
    }
}
