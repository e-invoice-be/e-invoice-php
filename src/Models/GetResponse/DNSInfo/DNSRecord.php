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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $ip `required`
     */
    final public function __construct($ip)
    {
        $this->constructFromArgs(func_get_args());
    }
}

DNSRecord::_loadMetadata();
