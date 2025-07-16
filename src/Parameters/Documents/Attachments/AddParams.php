<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class AddParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $file;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $file)
    {
        $this->file = $file;
    }
}

AddParams::_loadMetadata();
