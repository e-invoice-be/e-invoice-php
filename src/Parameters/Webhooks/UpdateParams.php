<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\UnionOf;
use EInvoiceAPI\Core\Serde\ListOf;

class UpdateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?bool $enabled;

    /**
     * @var list<string>|null $events
     */
    #[Api(type: new UnionOf([new ListOf('string'), 'null']), optional: true)]
    public ?array $events;

    #[Api(optional: true)]
    public ?string $url;
}

UpdateParams::_loadMetadata();
