<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

class CreateParams implements BaseModel
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
}

CreateParams::_loadMetadata();
