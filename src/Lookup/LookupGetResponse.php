<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetResponse\BusinessCard;
use EInvoiceAPI\Lookup\LookupGetResponse\DNSInfo;
use EInvoiceAPI\Lookup\LookupGetResponse\QueryMetadata;
use EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata;

/**
 * Response from a Peppol ID lookup operation.
 *
 * This model represents the complete result of validating and looking up a Peppol ID
 * in the Peppol network, including DNS information, service metadata, business card
 * details, and certificate information.
 *
 * Example:
 *     A successful lookup for a Peppol ID "0192:991825827" would return DNS information,
 *     service metadata with supported document types and processes, business card information
 *     with organization details, and certificate data.
 */
final class LookupGetResponse implements BaseModel
{
    use SdkModel;

    /**
     * Business card information for the Peppol participant.
     */
    #[Api]
    public BusinessCard $businessCard;

    /**
     * List of certificates found for the Peppol participant.
     *
     * @var list<Certificate> $certificates
     */
    #[Api(list: Certificate::class)]
    public array $certificates;

    /**
     * Information about the DNS lookup performed.
     */
    #[Api]
    public DNSInfo $dnsInfo;

    /**
     * List of error messages if any errors occurred during the lookup.
     *
     * @var list<string> $errors
     */
    #[Api(list: 'string')]
    public array $errors;

    /**
     * Total execution time of the lookup operation in milliseconds.
     */
    #[Api]
    public float $executionTimeMs;

    /**
     * Metadata about the query that was performed.
     */
    #[Api]
    public QueryMetadata $queryMetadata;

    /**
     * Service metadata information for the Peppol participant.
     */
    #[Api]
    public ServiceMetadata $serviceMetadata;

    /**
     * Overall status of the lookup: 'success' or 'error'.
     */
    #[Api]
    public string $status;

    /**
     * `new LookupGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LookupGetResponse::with(
     *   businessCard: ...,
     *   certificates: ...,
     *   dnsInfo: ...,
     *   errors: ...,
     *   executionTimeMs: ...,
     *   queryMetadata: ...,
     *   serviceMetadata: ...,
     *   status: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LookupGetResponse)
     *   ->withBusinessCard(...)
     *   ->withCertificates(...)
     *   ->withDNSInfo(...)
     *   ->withErrors(...)
     *   ->withExecutionTimeMs(...)
     *   ->withQueryMetadata(...)
     *   ->withServiceMetadata(...)
     *   ->withStatus(...)
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
     * @param list<Certificate> $certificates
     * @param list<string> $errors
     */
    public static function with(
        BusinessCard $businessCard,
        array $certificates,
        DNSInfo $dnsInfo,
        array $errors,
        float $executionTimeMs,
        QueryMetadata $queryMetadata,
        ServiceMetadata $serviceMetadata,
        string $status,
    ): self {
        $obj = new self;

        $obj->businessCard = $businessCard;
        $obj->certificates = $certificates;
        $obj->dnsInfo = $dnsInfo;
        $obj->errors = $errors;
        $obj->executionTimeMs = $executionTimeMs;
        $obj->queryMetadata = $queryMetadata;
        $obj->serviceMetadata = $serviceMetadata;
        $obj->status = $status;

        return $obj;
    }

    /**
     * Business card information for the Peppol participant.
     */
    public function withBusinessCard(BusinessCard $businessCard): self
    {
        $obj = clone $this;
        $obj->businessCard = $businessCard;

        return $obj;
    }

    /**
     * List of certificates found for the Peppol participant.
     *
     * @param list<Certificate> $certificates
     */
    public function withCertificates(array $certificates): self
    {
        $obj = clone $this;
        $obj->certificates = $certificates;

        return $obj;
    }

    /**
     * Information about the DNS lookup performed.
     */
    public function withDNSInfo(DNSInfo $dnsInfo): self
    {
        $obj = clone $this;
        $obj->dnsInfo = $dnsInfo;

        return $obj;
    }

    /**
     * List of error messages if any errors occurred during the lookup.
     *
     * @param list<string> $errors
     */
    public function withErrors(array $errors): self
    {
        $obj = clone $this;
        $obj->errors = $errors;

        return $obj;
    }

    /**
     * Total execution time of the lookup operation in milliseconds.
     */
    public function withExecutionTimeMs(float $executionTimeMs): self
    {
        $obj = clone $this;
        $obj->executionTimeMs = $executionTimeMs;

        return $obj;
    }

    /**
     * Metadata about the query that was performed.
     */
    public function withQueryMetadata(QueryMetadata $queryMetadata): self
    {
        $obj = clone $this;
        $obj->queryMetadata = $queryMetadata;

        return $obj;
    }

    /**
     * Service metadata information for the Peppol participant.
     */
    public function withServiceMetadata(ServiceMetadata $serviceMetadata): self
    {
        $obj = clone $this;
        $obj->serviceMetadata = $serviceMetadata;

        return $obj;
    }

    /**
     * Overall status of the lookup: 'success' or 'error'.
     */
    public function withStatus(string $status): self
    {
        $obj = clone $this;
        $obj->status = $status;

        return $obj;
    }
}
