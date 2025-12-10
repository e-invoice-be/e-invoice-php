<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Metadata about the query that was performed.
 *
 * @phpstan-type QueryMetadataShape = array{
 *   identifierScheme: string,
 *   identifierValue: string,
 *   smlDomain: string,
 *   timestamp: string,
 *   version: string,
 * }
 */
final class QueryMetadata implements BaseModel
{
    /** @use SdkModel<QueryMetadataShape> */
    use SdkModel;

    /**
     * Scheme of the identifier, typically 'iso6523-actorid-upis'.
     */
    #[Required]
    public string $identifierScheme;

    /**
     * The actual Peppol ID value being queried.
     */
    #[Required]
    public string $identifierValue;

    /**
     * Domain of the SML (Service Metadata Locator) used for the lookup.
     */
    #[Required]
    public string $smlDomain;

    /**
     * ISO 8601 timestamp of when the query was executed.
     */
    #[Required]
    public string $timestamp;

    /**
     * Version of the API used for the lookup.
     */
    #[Required]
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
        $self = new self;

        $self['identifierScheme'] = $identifierScheme;
        $self['identifierValue'] = $identifierValue;
        $self['smlDomain'] = $smlDomain;
        $self['timestamp'] = $timestamp;
        $self['version'] = $version;

        return $self;
    }

    /**
     * Scheme of the identifier, typically 'iso6523-actorid-upis'.
     */
    public function withIdentifierScheme(string $identifierScheme): self
    {
        $self = clone $this;
        $self['identifierScheme'] = $identifierScheme;

        return $self;
    }

    /**
     * The actual Peppol ID value being queried.
     */
    public function withIdentifierValue(string $identifierValue): self
    {
        $self = clone $this;
        $self['identifierValue'] = $identifierValue;

        return $self;
    }

    /**
     * Domain of the SML (Service Metadata Locator) used for the lookup.
     */
    public function withSmlDomain(string $smlDomain): self
    {
        $self = clone $this;
        $self['smlDomain'] = $smlDomain;

        return $self;
    }

    /**
     * ISO 8601 timestamp of when the query was executed.
     */
    public function withTimestamp(string $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    /**
     * Version of the API used for the lookup.
     */
    public function withVersion(string $version): self
    {
        $self = clone $this;
        $self['version'] = $version;

        return $self;
    }
}
