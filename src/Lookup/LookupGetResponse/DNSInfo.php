<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\DNSInfo\DNSRecord;

/**
 * Information about the DNS lookup performed.
 */
final class DNSInfo implements BaseModel
{
    use SdkModel;

    /**
     * List of DNS records found for the Peppol participant.
     *
     * @var list<DNSRecord> $dnsRecords
     */
    #[Api(list: DNSRecord::class)]
    public array $dnsRecords;

    /**
     * Hostname of the SML used for the query.
     */
    #[Api]
    public string $smlHostname;

    /**
     * Status of the DNS lookup: 'success', 'error', or 'pending'.
     */
    #[Api]
    public string $status;

    /**
     * Error message if the DNS lookup failed.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $error;

    /**
     * `new DNSInfo()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DNSInfo::with(dnsRecords: ..., smlHostname: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DNSInfo)->withDNSRecords(...)->withSmlHostname(...)->withStatus(...)
     * ```
     */
    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DNSRecord> $dnsRecords
     */
    public static function with(
        array $dnsRecords,
        string $smlHostname,
        string $status,
        ?string $error = null,
    ): self {
        $obj = new self;

        $obj->dnsRecords = $dnsRecords;
        $obj->smlHostname = $smlHostname;
        $obj->status = $status;

        null !== $error && $obj->error = $error;

        return $obj;
    }

    /**
     * List of DNS records found for the Peppol participant.
     *
     * @param list<DNSRecord> $dnsRecords
     */
    public function withDNSRecords(array $dnsRecords): self
    {
        $obj = clone $this;
        $obj->dnsRecords = $dnsRecords;

        return $obj;
    }

    /**
     * Hostname of the SML used for the query.
     */
    public function withSmlHostname(string $smlHostname): self
    {
        $obj = clone $this;
        $obj->smlHostname = $smlHostname;

        return $obj;
    }

    /**
     * Status of the DNS lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Error message if the DNS lookup failed.
     */
    public function withError(?string $error): self
    {
        $obj = clone $this;
        $obj->error = $error;

        return $obj;
    }
}
