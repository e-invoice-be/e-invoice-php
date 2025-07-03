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

    /**
     * @var list<string> $events
     */
    #[Api(type: new ListOf('string'))]
    public array $events;

    #[Api]
    public string $secret;

    #[Api]
    public string $url;

    #[Api(optional: true)]
    public bool $enabled;

    /**
     * @param list<string> $events
     * @param bool         $enabled
     */
    final public function __construct(
        string $id,
        array $events,
        string $secret,
        string $url,
        bool|None $enabled = None::NOT_SET
    ) {
        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);
    }
}

WebhookResponse::_loadMetadata();
