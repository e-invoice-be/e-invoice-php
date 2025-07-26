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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function new(string $ip): self
    {
        $obj = new self;

        $obj->ip = $ip;

        return $obj;
    }

    /**
     * IP address found in the DNS record.
     */
    public function setIP(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }
}
