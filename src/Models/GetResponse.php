<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;

class GetResponse implements BaseModel
{
    use Model;

    /**
     * @var array{
     *
     *     entities?: list<array{
     *
     *         additionalInformation?: list<string>|null,
     *         countryCode?: string|null,
     *         name?: string|null,
     *         registrationDate?: string|null,
     *
     * }>,
     *     queryTimeMs?: float,
     *     status?: string,
     *     error?: string|null,
     *
     * } $businessCard
     */
    #[Api]
    public array $businessCard;

    /**
     * @var list<Certificate> $certificates
     */
    #[Api(type: new ListOf(Certificate::class))]
    public array $certificates;

    /**
     * @var array{
     *
     *     dnsRecords?: list<array{ip?: string}>,
     *     smlHostname?: string,
     *     status?: string,
     *     error?: string|null,
     *
     * } $dnsInfo
     */
    #[Api]
    public array $dnsInfo;

    /**
     * @var list<string> $errors
     */
    #[Api(type: new ListOf('string'))]
    public array $errors;

    #[Api]
    public float $executionTimeMs;

    /**
     * @var array{
     *
     *     identifierScheme?: string,
     *     identifierValue?: string,
     *     smlDomain?: string,
     *     timestamp?: string,
     *     version?: string,
     *
     * } $queryMetadata
     */
    #[Api]
    public array $queryMetadata;

    /**
     * @var array{
     *
     *     endpoints?: list<array{
     *
     *         documentTypes?: list<array{scheme?: string, value?: string}>,
     *         status?: string,
     *         url?: string,
     *         error?: string|null,
     *         processes?: list<array{
     *
     *             endpoints?: list<array{
     *
     *                 address?: string,
     *                 transportProfile?: string,
     *                 certificate?: Certificate,
     *                 serviceActivationDate?: string|null,
     *                 serviceDescription?: string|null,
     *                 serviceExpirationDate?: string|null,
     *                 technicalContactURL?: string|null,
     *                 technicalInformationURL?: string|null,
     *
     * }>,
     *             processID?: array{scheme?: string, value?: string},
     *
     * }>|null,
     *
     * }>,
     *     queryTimeMs?: float,
     *     status?: string,
     *     error?: string|null,
     *
     * } $serviceMetadata
     */
    #[Api]
    public array $serviceMetadata;

    #[Api]
    public string $status;

    /**
     * @param array{
     *
     *     entities?: list<array{
     *
     *         additionalInformation?: list<string>|null,
     *         countryCode?: string|null,
     *         name?: string|null,
     *         registrationDate?: string|null,
     *
     * }>,
     *     queryTimeMs?: float,
     *     status?: string,
     *     error?: string|null,
     *
     * } $businessCard
     * @param list<Certificate> $certificates
     * @param array{
     *
     *     dnsRecords?: list<array{ip?: string}>,
     *     smlHostname?: string,
     *     status?: string,
     *     error?: string|null,
     *
     * } $dnsInfo
     * @param list<string> $errors
     * @param array{
     *
     *     identifierScheme?: string,
     *     identifierValue?: string,
     *     smlDomain?: string,
     *     timestamp?: string,
     *     version?: string,
     *
     * } $queryMetadata
     * @param array{
     *
     *     endpoints?: list<array{
     *
     *         documentTypes?: list<array{scheme?: string, value?: string}>,
     *         status?: string,
     *         url?: string,
     *         error?: string|null,
     *         processes?: list<array{
     *
     *             endpoints?: list<array{
     *
     *                 address?: string,
     *                 transportProfile?: string,
     *                 certificate?: Certificate,
     *                 serviceActivationDate?: string|null,
     *                 serviceDescription?: string|null,
     *                 serviceExpirationDate?: string|null,
     *                 technicalContactURL?: string|null,
     *                 technicalInformationURL?: string|null,
     *
     * }>,
     *             processID?: array{scheme?: string, value?: string},
     *
     * }>|null,
     *
     * }>,
     *     queryTimeMs?: float,
     *     status?: string,
     *     error?: string|null,
     *
     * } $serviceMetadata
     */
    final public function __construct(
        array $businessCard,
        array $certificates,
        array $dnsInfo,
        array $errors,
        float $executionTimeMs,
        array $queryMetadata,
        array $serviceMetadata,
        string $status,
    ) {

        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);

    }
}

GetResponse::_loadMetadata();
