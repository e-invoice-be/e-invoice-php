<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetResponse\DNSInfo\DNSRecord;

final class DNSInfo implements BaseModel
{
    use Model;

    /** @var list<DNSRecord> $dnsRecords */
    #[Api(type: new ListOf(DNSRecord::class))]
    public array $dnsRecords;

    #[Api]
    public string $smlHostname;

    #[Api]
    public string $status;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param list<DNSRecord> $dnsRecords  `required`
     * @param string          $smlHostname `required`
     * @param string          $status      `required`
     * @param null|string     $error
     */
    final public function __construct(
        $dnsRecords,
        $smlHostname,
        $status,
        $error = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

DNSInfo::_loadMetadata();
