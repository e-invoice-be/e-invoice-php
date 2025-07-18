<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

final class WebhookUpdateParam implements BaseModel
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

    /**
     * You must use named parameters to construct this object.
     *
     * @param null|list<string> $events
     */
    final public function __construct(
        ?bool $enabled = null,
        ?array $events = null,
        ?string $url = null
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        null !== $enabled && $this->enabled = $enabled;
        null !== $events && $this->events = $events;
        null !== $url && $this->url = $url;
    }
}
