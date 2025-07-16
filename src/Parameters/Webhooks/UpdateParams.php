<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;

final class UpdateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?bool $enabled;

    /** @var null|list<string> $events */
    #[Api(type: new UnionOf([new ListOf('string'), 'null']), optional: true)]
    public ?array $events;

    #[Api(optional: true)]
    public ?string $url;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|bool         $enabled
     * @param null|list<string> $events
     * @param null|string       $url
     */
    final public function __construct(
        $enabled = None::NOT_GIVEN,
        $events = None::NOT_GIVEN,
        $url = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

UpdateParams::_loadMetadata();
