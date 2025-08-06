<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Create a new webhook.
 *
 * @phpstan-type create_params1 = array{
 *   events: list<string>, url: string, enabled?: bool
 * }
 */
final class WebhookCreateParams implements BaseModel
{
    use Model;
    use Params;

    /** @var list<string> $events */
    #[Api(type: new ListOf('string'))]
    public array $events;

    #[Api]
    public string $url;

    #[Api(optional: true)]
    public ?bool $enabled;

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
    public static function new(
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
}
