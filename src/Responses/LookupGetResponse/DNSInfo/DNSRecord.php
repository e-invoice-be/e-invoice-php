<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\DNSInfo;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * DNS record information for a Peppol participant.
 *
 * @phpstan-type dns_record_alias = array{ip: string}
 */
final class DNSRecord implements BaseModel
{
    use Model;

    /**
     * IP address found in the DNS record.
     */
    #[Api]
    public string $ip;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $ip)
    {
        self::introspect();

        $this->ip = $ip;
    }
}
