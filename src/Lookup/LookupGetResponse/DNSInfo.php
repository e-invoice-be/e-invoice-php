<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\DNSInfo\DNSRecord;

/**
 * Information about the DNS lookup performed.
 *
 * @phpstan-type DNSInfoShape = array{
 *   dnsRecords: list<DNSRecord>,
 *   smlHostname: string,
 *   status: string,
 *   error?: string|null,
 * }
 */
final class DNSInfo implements BaseModel
{
    /** @use SdkModel<DNSInfoShape> */
    use SdkModel;

    /**
     * List of DNS records found for the Peppol participant.
     *
     * @var list<DNSRecord> $dnsRecords
     */
    #[Required(list: DNSRecord::class)]
    public array $dnsRecords;

    /**
     * Hostname of the SML used for the query.
     */
    #[Required]
    public string $smlHostname;

    /**
     * Status of the DNS lookup: 'success', 'error', or 'pending'.
     */
    #[Required]
    public string $status;

    /**
     * Error message if the DNS lookup failed.
     */
    #[Optional(nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DNSRecord|array{ip: string}> $dnsRecords
     */
    public static function with(
        array $dnsRecords,
        string $smlHostname,
        string $status,
        ?string $error = null,
    ): self {
        $self = new self;

        $self['dnsRecords'] = $dnsRecords;
        $self['smlHostname'] = $smlHostname;
        $self['status'] = $status;

        null !== $error && $self['error'] = $error;

        return $self;
    }

    /**
     * List of DNS records found for the Peppol participant.
     *
     * @param list<DNSRecord|array{ip: string}> $dnsRecords
     */
    public function withDNSRecords(array $dnsRecords): self
    {
        $self = clone $this;
        $self['dnsRecords'] = $dnsRecords;

        return $self;
    }

    /**
     * Hostname of the SML used for the query.
     */
    public function withSmlHostname(string $smlHostname): self
    {
        $self = clone $this;
        $self['smlHostname'] = $smlHostname;

        return $self;
    }

    /**
     * Status of the DNS lookup: 'success', 'error', or 'pending'.
     */
    public function withStatus(string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * Error message if the DNS lookup failed.
     */
    public function withError(?string $error): self
    {
        $self = clone $this;
        $self['error'] = $error;

        return $self;
    }
}
