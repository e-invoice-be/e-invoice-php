<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Responses\LookupGetResponse\DNSInfo\DNSRecord;

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
     * You must use named parameters to construct this object.
     *
     * @param list<DNSRecord> $dnsRecords
     */
    final public function __construct(
        array $dnsRecords,
        string $smlHostname,
        string $status,
        ?string $error = null,
    ) {
        $this->dnsRecords = $dnsRecords;
        $this->smlHostname = $smlHostname;
        $this->status = $status;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $error && $this->error = $error;
    }
}
