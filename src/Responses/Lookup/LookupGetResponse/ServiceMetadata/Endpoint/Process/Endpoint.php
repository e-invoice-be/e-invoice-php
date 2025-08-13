<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\Certificate;

/**
 * Endpoint information for a specific Peppol process.
 *
 * @phpstan-type endpoint_alias = array{
 *   address: string,
 *   transportProfile: string,
 *   certificate?: Certificate,
 *   serviceActivationDate?: string|null,
 *   serviceDescription?: string|null,
 *   serviceExpirationDate?: string|null,
 *   technicalContactURL?: string|null,
 *   technicalInformationURL?: string|null,
 * }
 */
final class Endpoint implements BaseModel
{
    use Model;

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
    public static function from(
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
    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Transport profile used by this endpoint.
     */
    public function setTransportProfile(string $transportProfile): self
    {
        $this->transportProfile = $transportProfile;

        return $this;
    }

    /**
     * Certificate information for a Peppol endpoint.
     */
    public function setCertificate(Certificate $certificate): self
    {
        $this->certificate = $certificate;

        return $this;
    }

    /**
     * ISO 8601 date when the service was activated.
     */
    public function setServiceActivationDate(
        ?string $serviceActivationDate
    ): self {
        $this->serviceActivationDate = $serviceActivationDate;

        return $this;
    }

    /**
     * Human-readable description of the service.
     */
    public function setServiceDescription(?string $serviceDescription): self
    {
        $this->serviceDescription = $serviceDescription;

        return $this;
    }

    /**
     * ISO 8601 date when the service will expire.
     */
    public function setServiceExpirationDate(
        ?string $serviceExpirationDate
    ): self {
        $this->serviceExpirationDate = $serviceExpirationDate;

        return $this;
    }

    /**
     * URL for technical contact information.
     */
    public function setTechnicalContactURL(?string $technicalContactURL): self
    {
        $this->technicalContactURL = $technicalContactURL;

        return $this;
    }

    /**
     * URL for technical documentation.
     */
    public function setTechnicalInformationURL(
        ?string $technicalInformationURL
    ): self {
        $this->technicalInformationURL = $technicalInformationURL;

        return $this;
    }
}
