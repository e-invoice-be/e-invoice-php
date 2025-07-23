<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Metadata about the query that was performed.
 *
 * @phpstan-type query_metadata_alias = array{
 *   identifierScheme: string,
 *   identifierValue: string,
 *   smlDomain: string,
 *   timestamp: string,
 *   version: string,
 * }
 */
final class QueryMetadata implements BaseModel
{
    use Model;

    /**
     * Scheme of the identifier, typically 'iso6523-actorid-upis'.
     */
    #[Api]
    public string $identifierScheme;

    /**
     * The actual Peppol ID value being queried.
     */
    #[Api]
    public string $identifierValue;

    /**
     * Domain of the SML (Service Metadata Locator) used for the lookup.
     */
    #[Api]
    public string $smlDomain;

    /**
     * ISO 8601 timestamp of when the query was executed.
     */
    #[Api]
    public string $timestamp;

    /**
     * Version of the API used for the lookup.
     */
    #[Api]
    public string $version;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        string $identifierScheme,
        string $identifierValue,
        string $smlDomain,
        string $timestamp,
        string $version,
    ) {
        self::introspect();

        $this->identifierScheme = $identifierScheme;
        $this->identifierValue = $identifierValue;
        $this->smlDomain = $smlDomain;
        $this->timestamp = $timestamp;
        $this->version = $version;
    }
}
