<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;

/**
 * Response model for webhook API endpoints.
 *
 * @phpstan-type webhook_response_alias = array{
 *   id: string, events: list<string>, secret: string, url: string, enabled?: bool
 * }
 */
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
        string $id,
        array $events,
        string $secret,
        string $url,
        ?bool $enabled = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->events = $events;
        $obj->secret = $secret;
        $obj->url = $url;

        null !== $enabled && $obj->enabled = $enabled;

        return $obj;
    }

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param list<string> $events
     */
    public function setEvents(array $events): self
    {
        $this->events = $events;

        return $this;
    }

    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    public function setURL(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function setEnabled(bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }
}
