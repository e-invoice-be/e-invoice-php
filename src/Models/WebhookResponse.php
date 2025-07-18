<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

final class WebhookResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    /** @var list<string> $events */
    #[Api(type: new ListOf('string'))]
    public array $events;

    #[Api]
    public string $secret;

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
        string $id,
        array $events,
        string $secret,
        string $url,
        ?bool $enabled = null,
    ) {
        $this->id = $id;
        $this->events = $events;
        $this->secret = $secret;
        $this->url = $url;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $enabled && $this->enabled = $enabled;
    }
}
