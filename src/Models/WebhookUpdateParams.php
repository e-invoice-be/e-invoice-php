<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
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
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?bool $enabled;

    /** @var null|list<string> $events */
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
     * @param null|list<string> $events
     */
    public static function new(
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
}
