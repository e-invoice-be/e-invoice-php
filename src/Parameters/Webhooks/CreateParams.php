<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;

final class CreateParams implements BaseModel
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<string> $events  `required`
     * @param string       $url     `required`
     * @param null|bool    $enabled
     */
    final public function __construct($events, $url, $enabled = None::NOT_GIVEN)
    {
        $this->constructFromArgs(func_get_args());
    }
}

CreateParams::_loadMetadata();
