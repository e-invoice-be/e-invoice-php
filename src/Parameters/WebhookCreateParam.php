<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

final class WebhookCreateParam implements BaseModel
{
    use Model;
    use Params;

    /** @var list<string> $events */
    #[Api(type: new ListOf('string'))]
    public array $events;

    #[Api]
    public string $url;

    #[Api(optional: true)]
    public ?bool $enabled = true;

    /**
     * You must use named parameters to construct this object.
     *
     * @param list<string> $events
     */
    final public function __construct(
        array $events,
        string $url,
        ?bool $enabled = null
    ) {
        $this->events = $events;
        $this->url = $url;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $enabled && $this->enabled = $enabled;
    }
}
