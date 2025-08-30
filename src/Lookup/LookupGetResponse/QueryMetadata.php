<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Metadata about the query that was performed.
 *
 * @phpstan-type query_metadata = array{
 *   identifierScheme: string,
 *   identifierValue: string,
 *   smlDomain: string,
 *   timestamp: string,
 *   version: string,
 * }
 */
final class QueryMetadata implements BaseModel
{
    /** @use SdkModel<query_metadata> */
    use SdkModel;

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
     * `new QueryMetadata()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QueryMetadata::with(
     *   identifierScheme: ...,
     *   identifierValue: ...,
     *   smlDomain: ...,
     *   timestamp: ...,
     *   version: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QueryMetadata)
     *   ->withIdentifierScheme(...)
     *   ->withIdentifierValue(...)
     *   ->withSmlDomain(...)
     *   ->withTimestamp(...)
     *   ->withVersion(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
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
    public function withIdentifierScheme(string $identifierScheme): self
    {
        $obj = clone $this;
        $obj->identifierScheme = $identifierScheme;

        return $obj;
    }

    /**
     * The actual Peppol ID value being queried.
     */
    public function withIdentifierValue(string $identifierValue): self
    {
        $obj = clone $this;
        $obj->identifierValue = $identifierValue;

        return $obj;
    }

    /**
     * Domain of the SML (Service Metadata Locator) used for the lookup.
     */
    public function withSmlDomain(string $smlDomain): self
    {
        $obj = clone $this;
        $obj->smlDomain = $smlDomain;

        return $obj;
    }

    /**
     * ISO 8601 timestamp of when the query was executed.
     */
    public function withTimestamp(string $timestamp): self
    {
        $obj = clone $this;
        $obj->timestamp = $timestamp;

        return $obj;
    }

    /**
     * Version of the API used for the lookup.
     */
    public function withVersion(string $version): self
    {
        $obj = clone $this;
        $obj->version = $version;

        return $obj;
    }
}
