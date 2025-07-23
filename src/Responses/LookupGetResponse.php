<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\Certificate;
use EInvoiceAPI\Responses\LookupGetResponse\BusinessCard;
use EInvoiceAPI\Responses\LookupGetResponse\DNSInfo;
use EInvoiceAPI\Responses\LookupGetResponse\QueryMetadata;
use EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata;

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
 *
 * @phpstan-type lookup_get_response_alias = array{
 *   businessCard: BusinessCard,
 *   certificates: list<Certificate>,
 *   dnsInfo: DNSInfo,
 *   errors: list<string>,
 *   executionTimeMs: float,
 *   queryMetadata: QueryMetadata,
 *   serviceMetadata: ServiceMetadata,
 *   status: string,
 * }
 */
final class LookupGetResponse implements BaseModel
{
    use Model;

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
    #[Api(type: new ListOf(Certificate::class))]
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
    #[Api(type: new ListOf('string'))]
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
        self::introspect();

        $this->businessCard = $businessCard;
        $this->certificates = $certificates;
        $this->dnsInfo = $dnsInfo;
        $this->errors = $errors;
        $this->executionTimeMs = $executionTimeMs;
        $this->queryMetadata = $queryMetadata;
        $this->serviceMetadata = $serviceMetadata;
        $this->status = $status;
    }
}
