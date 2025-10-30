<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\DNSInfo;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * DNS record information for a Peppol participant.
 *
 * @phpstan-type DNSRecordShape = array{ip: string}
 */
final class DNSRecord implements BaseModel
{
    /** @use SdkModel<DNSRecordShape> */
    use SdkModel;

    /**
     * IP address found in the DNS record.
     */
    #[Api]
    public string $ip;

    /**
     * `new DNSRecord()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DNSRecord::with(ip: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DNSRecord)->withIP(...)
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
     */
    public static function with(string $ip): self
    {
        $obj = new self;

        $obj->ip = $ip;

        return $obj;
    }

    /**
     * IP address found in the DNS record.
     */
    public function withIP(string $ip): self
    {
        $obj = clone $this;
        $obj->ip = $ip;

        return $obj;
    }
}
