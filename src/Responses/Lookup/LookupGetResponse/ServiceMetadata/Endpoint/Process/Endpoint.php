<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\Certificate;

/**
 * Endpoint information for a specific Peppol process.
 */
final class Endpoint implements BaseModel
{
    use SdkModel;

    /**
     * URL or address of the endpoint.
     */
    #[Api]
    public string $address;

    /**
     * Transport profile used by this endpoint.
     */
    #[Api]
    public string $transportProfile;

    /**
     * Certificate information for a Peppol endpoint.
     */
    #[Api(optional: true)]
    public ?Certificate $certificate;

    /**
     * ISO 8601 date when the service was activated.
     */
    #[Api(optional: true)]
    public ?string $serviceActivationDate;

    /**
     * Human-readable description of the service.
     */
    #[Api(optional: true)]
    public ?string $serviceDescription;

    /**
     * ISO 8601 date when the service will expire.
     */
    #[Api(optional: true)]
    public ?string $serviceExpirationDate;

    /**
     * URL for technical contact information.
     */
    #[Api('technicalContactUrl', optional: true)]
    public ?string $technicalContactURL;

    /**
     * URL for technical documentation.
     */
    #[Api('technicalInformationUrl', optional: true)]
    public ?string $technicalInformationURL;

    /**
     * `new Endpoint()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Endpoint::with(address: ..., transportProfile: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Endpoint)->withAddress(...)->withTransportProfile(...)
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
     */
    public static function with(
        string $address,
        string $transportProfile,
        ?Certificate $certificate = null,
        ?string $serviceActivationDate = null,
        ?string $serviceDescription = null,
        ?string $serviceExpirationDate = null,
        ?string $technicalContactURL = null,
        ?string $technicalInformationURL = null,
    ): self {
        $obj = new self;

        $obj->address = $address;
        $obj->transportProfile = $transportProfile;

        null !== $certificate && $obj->certificate = $certificate;
        null !== $serviceActivationDate && $obj->serviceActivationDate = $serviceActivationDate;
        null !== $serviceDescription && $obj->serviceDescription = $serviceDescription;
        null !== $serviceExpirationDate && $obj->serviceExpirationDate = $serviceExpirationDate;
        null !== $technicalContactURL && $obj->technicalContactURL = $technicalContactURL;
        null !== $technicalInformationURL && $obj->technicalInformationURL = $technicalInformationURL;

        return $obj;
    }

    /**
     * URL or address of the endpoint.
     */
    public function withAddress(string $address): self
    {
        $obj = clone $this;
        $obj->address = $address;

        return $obj;
    }

    /**
     * Transport profile used by this endpoint.
     */
    public function withTransportProfile(string $transportProfile): self
    {
        $obj = clone $this;
        $obj->transportProfile = $transportProfile;

        return $obj;
    }

    /**
     * Certificate information for a Peppol endpoint.
     */
    public function withCertificate(Certificate $certificate): self
    {
        $obj = clone $this;
        $obj->certificate = $certificate;

        return $obj;
    }

    /**
     * ISO 8601 date when the service was activated.
     */
    public function withServiceActivationDate(
        ?string $serviceActivationDate
    ): self {
        $obj = clone $this;
        $obj->serviceActivationDate = $serviceActivationDate;

        return $obj;
    }

    /**
     * Human-readable description of the service.
     */
    public function withServiceDescription(?string $serviceDescription): self
    {
        $obj = clone $this;
        $obj->serviceDescription = $serviceDescription;

        return $obj;
    }

    /**
     * ISO 8601 date when the service will expire.
     */
    public function withServiceExpirationDate(
        ?string $serviceExpirationDate
    ): self {
        $obj = clone $this;
        $obj->serviceExpirationDate = $serviceExpirationDate;

        return $obj;
    }

    /**
     * URL for technical contact information.
     */
    public function withTechnicalContactURL(?string $technicalContactURL): self
    {
        $obj = clone $this;
        $obj->technicalContactURL = $technicalContactURL;

        return $obj;
    }

    /**
     * URL for technical documentation.
     */
    public function withTechnicalInformationURL(
        ?string $technicalInformationURL
    ): self {
        $obj = clone $this;
        $obj->technicalInformationURL = $technicalInformationURL;

        return $obj;
    }
}
