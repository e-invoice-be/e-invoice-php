<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Update a webhook by ID.
 *
 * @phpstan-type update_params = array{
 *   enabled?: bool|null, events?: list<string>|null, url?: string|null
 * }
 */
final class WebhookUpdateParams implements BaseModel
{
    use SdkModel;
    use SdkParams;

    #[Api(optional: true)]
    public ?bool $enabled;

    /** @var list<string>|null $events */
    #[Api(type: new ListOf('string'), nullable: true, optional: true)]
    public ?array $events;

    #[Api(optional: true)]
    public ?string $url;

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
     * @param list<string>|null $events
     */
    public static function with(
        ?bool $enabled = null,
        ?array $events = null,
        ?string $url = null
    ): self {
        $obj = new self;

        null !== $enabled && $obj->enabled = $enabled;
        null !== $events && $obj->events = $events;
        null !== $url && $obj->url = $url;

        return $obj;
    }

    public function withEnabled(?bool $enabled): self
    {
        $obj = clone $this;
        $obj->enabled = $enabled;

        return $obj;
    }

    /**
     * @param list<string>|null $events
     */
    public function withEvents(?array $events): self
    {
        $obj = clone $this;
        $obj->events = $events;

        return $obj;
    }

    public function withURL(?string $url): self
    {
        $obj = clone $this;
        $obj->url = $url;

        return $obj;
    }
}
