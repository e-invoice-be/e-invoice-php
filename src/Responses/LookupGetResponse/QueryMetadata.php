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
    public static function new(
        string $identifierScheme,
        string $identifierValue,
        string $smlDomain,
        string $timestamp,
        string $version,
    ): self {
        $obj = new self;

        $obj->identifierScheme = $identifierScheme;
        $obj->identifierValue = $identifierValue;
        $obj->smlDomain = $smlDomain;
        $obj->timestamp = $timestamp;
        $obj->version = $version;

        return $obj;
    }

    /**
     * Scheme of the identifier, typically 'iso6523-actorid-upis'.
     */
    public function setIdentifierScheme(string $identifierScheme): self
    {
        $this->identifierScheme = $identifierScheme;

        return $this;
    }

    /**
     * The actual Peppol ID value being queried.
     */
    public function setIdentifierValue(string $identifierValue): self
    {
        $this->identifierValue = $identifierValue;

        return $this;
    }

    /**
     * Domain of the SML (Service Metadata Locator) used for the lookup.
     */
    public function setSmlDomain(string $smlDomain): self
    {
        $this->smlDomain = $smlDomain;

        return $this;
    }

    /**
     * ISO 8601 timestamp of when the query was executed.
     */
    public function setTimestamp(string $timestamp): self
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Version of the API used for the lookup.
     */
    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
