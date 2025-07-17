<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\DNSInfo;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DNSRecord implements BaseModel
{
    use Model;

    #[Api]
    public string $ip;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $ip)
    {
        $this->ip = $ip;
    }
}

DNSRecord::__introspect();
