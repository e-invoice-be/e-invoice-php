<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;

class WebhookResponse implements BaseModel
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

    /**
     * @param string       $id
     * @param list<string> $events
     * @param string       $secret
     * @param string       $url
     * @param null|bool    $enabled
     */
    final public function __construct(
        $id,
        $events,
        $secret,
        $url,
        $enabled = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

WebhookResponse::_loadMetadata();
