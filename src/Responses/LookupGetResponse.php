<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\Certificate;
use EInvoiceAPI\Responses\LookupGetResponse\BusinessCard;
use EInvoiceAPI\Responses\LookupGetResponse\DNSInfo;
use EInvoiceAPI\Responses\LookupGetResponse\QueryMetadata;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata;

final class LookupGetResponse implements BaseModel
{
    use Model;

    #[Api]
    public BusinessCard $businessCard;

    /** @var list<Certificate> $certificates */
    #[Api(type: new ListOf(Certificate::class))]
    public array $certificates;

    #[Api]
    public DNSInfo $dnsInfo;

    /** @var list<string> $errors */
    #[Api(type: new ListOf('string'))]
    public array $errors;

    #[Api]
    public float $executionTimeMs;

    #[Api]
    public QueryMetadata $queryMetadata;

    #[Api]
    public ServiceMetadata $serviceMetadata;

    #[Api]
    public string $status;

    /**
     * You must use named parameters to construct this object.
     *
     * @param list<Certificate> $certificates
     * @param list<string>      $errors
     */
    final public function __construct(
        BusinessCard $businessCard,
        array $certificates,
        DNSInfo $dnsInfo,
        array $errors,
        float $executionTimeMs,
        QueryMetadata $queryMetadata,
        ServiceMetadata $serviceMetadata,
        string $status,
    ) {
        $this->businessCard = $businessCard;
        $this->certificates = $certificates;
        $this->dnsInfo = $dnsInfo;
        $this->errors = $errors;
        $this->executionTimeMs = $executionTimeMs;
        $this->queryMetadata = $queryMetadata;
        $this->serviceMetadata = $serviceMetadata;
        $this->status = $status;

        self::_introspect();
    }
}
