<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

class GetResponse implements BaseModel
{
    use Model;

    /**
     * @var array{
     *   entities?: list<array{
     *     additionalInformation?: list<string>|null,
     *     countryCode?: string|null,
     *     name?: string|null,
     *     registrationDate?: string|null,
     *   }>,
     *   queryTimeMs?: float,
     *   status?: string,
     *   error?: string|null,
     * } $businessCard
     */
    #[Api]
    public array $businessCard;

    /** @var list<Certificate> $certificates */
    #[Api(type: new ListOf(Certificate::class))]
    public array $certificates;

    /**
     * @var array{
     *   dnsRecords?: list<array{ip?: string}>,
     *   smlHostname?: string,
     *   status?: string,
     *   error?: string|null,
     * } $dnsInfo
     */
    #[Api]
    public array $dnsInfo;

    /** @var list<string> $errors */
    #[Api(type: new ListOf('string'))]
    public array $errors;

    #[Api]
    public float $executionTimeMs;

    /**
     * @var array{
     *   identifierScheme?: string,
     *   identifierValue?: string,
     *   smlDomain?: string,
     *   timestamp?: string,
     *   version?: string,
     * } $queryMetadata
     */
    #[Api]
    public array $queryMetadata;

    /**
     * @var array{
     *   endpoints?: list<array{
     *     documentTypes?: list<array{scheme?: string, value?: string}>,
     *     status?: string,
     *     url?: string,
     *     error?: string|null,
     *     processes?: list<array{
     *       endpoints?: list<array{
     *         address?: string,
     *         transportProfile?: string,
     *         certificate?: Certificate,
     *         serviceActivationDate?: string|null,
     *         serviceDescription?: string|null,
     *         serviceExpirationDate?: string|null,
     *         technicalContactURL?: string|null,
     *         technicalInformationURL?: string|null,
     *       }>,
     *       processID?: array{scheme?: string, value?: string},
     *     }>|null,
     *   }>,
     *   queryTimeMs?: float,
     *   status?: string,
     *   error?: string|null,
     * } $serviceMetadata
     */
    #[Api]
    public array $serviceMetadata;

    #[Api]
    public string $status;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param array{
     *   entities?: list<array{
     *     additionalInformation?: list<string>|null,
     *     countryCode?: string|null,
     *     name?: string|null,
     *     registrationDate?: string|null,
     *   }>,
     *   queryTimeMs?: float,
     *   status?: string,
     *   error?: string|null,
     * } $businessCard `required`
     * @param list<Certificate> $certificates `required`
     * @param array{
     *   dnsRecords?: list<array{ip?: string}>,
     *   smlHostname?: string,
     *   status?: string,
     *   error?: string|null,
     * } $dnsInfo `required`
     * @param list<string> $errors          `required`
     * @param float        $executionTimeMs `required`
     * @param array{
     *   identifierScheme?: string,
     *   identifierValue?: string,
     *   smlDomain?: string,
     *   timestamp?: string,
     *   version?: string,
     * } $queryMetadata `required`
     * @param array{
     *   endpoints?: list<array{
     *     documentTypes?: list<array{scheme?: string, value?: string}>,
     *     status?: string,
     *     url?: string,
     *     error?: string|null,
     *     processes?: list<array{
     *       endpoints?: list<array{
     *         address?: string,
     *         transportProfile?: string,
     *         certificate?: Certificate,
     *         serviceActivationDate?: string|null,
     *         serviceDescription?: string|null,
     *         serviceExpirationDate?: string|null,
     *         technicalContactURL?: string|null,
     *         technicalInformationURL?: string|null,
     *       }>,
     *       processID?: array{scheme?: string, value?: string},
     *     }>|null,
     *   }>,
     *   queryTimeMs?: float,
     *   status?: string,
     *   error?: string|null,
     * } $serviceMetadata `required`
     * @param string $status `required`
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
