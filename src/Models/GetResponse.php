<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetResponse\BusinessCard;
use EInvoiceAPI\Models\GetResponse\DNSInfo;
use EInvoiceAPI\Models\GetResponse\QueryMetadata;
use EInvoiceAPI\Models\GetResponse\ServiceMetadata;

final class GetResponse implements BaseModel
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param BusinessCard      $businessCard    `required`
     * @param list<Certificate> $certificates    `required`
     * @param DNSInfo           $dnsInfo         `required`
     * @param list<string>      $errors          `required`
     * @param float             $executionTimeMs `required`
     * @param QueryMetadata     $queryMetadata   `required`
     * @param ServiceMetadata   $serviceMetadata `required`
     * @param string            $status          `required`
     */
    final public function __construct(
        $businessCard,
        $certificates,
        $dnsInfo,
        $errors,
        $executionTimeMs,
        $queryMetadata,
        $serviceMetadata,
        $status,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

GetResponse::_loadMetadata();
