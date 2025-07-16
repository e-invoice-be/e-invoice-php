<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string       $id      `required`
     * @param list<string> $events  `required`
     * @param string       $secret  `required`
     * @param string       $url     `required`
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
