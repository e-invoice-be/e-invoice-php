<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\Certificate;

/**
 * Endpoint information for a specific Peppol process.
 *
 * @phpstan-type EndpointShape = array{
 *   address: string,
 *   transportProfile: string,
 *   certificate?: Certificate|null,
 *   serviceActivationDate?: string|null,
 *   serviceDescription?: string|null,
 *   serviceExpirationDate?: string|null,
 *   technicalContactURL?: string|null,
 *   technicalInformationURL?: string|null,
 * }
 */
final class Endpoint implements BaseModel
{
    /** @use SdkModel<EndpointShape> */
    use SdkModel;

    /**
     * URL or address of the endpoint.
     */
    #[Required]
    public string $address;

    /**
     * Transport profile used by this endpoint.
     */
    #[Required]
    public string $transportProfile;

    /**
     * Certificate information for a Peppol endpoint.
     */
    #[Optional(nullable: true)]
    public ?Certificate $certificate;

    /**
     * ISO 8601 date when the service was activated.
     */
    #[Optional(nullable: true)]
    public ?string $serviceActivationDate;

    /**
     * Human-readable description of the service.
     */
    #[Optional(nullable: true)]
    public ?string $serviceDescription;

    /**
     * ISO 8601 date when the service will expire.
     */
    #[Optional(nullable: true)]
    public ?string $serviceExpirationDate;

    /**
     * URL for technical contact information.
     */
    #[Optional('technicalContactUrl', nullable: true)]
    public ?string $technicalContactURL;

    /**
     * URL for technical documentation.
     */
    #[Optional('technicalInformationUrl', nullable: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Certificate|array{
     *   status: string, details?: array<string,mixed>|null, error?: string|null
     * }|null $certificate
     */
    public static function with(
        string $address,
        string $transportProfile,
        Certificate|array|null $certificate = null,
        ?string $serviceActivationDate = null,
        ?string $serviceDescription = null,
        ?string $serviceExpirationDate = null,
        ?string $technicalContactURL = null,
        ?string $technicalInformationURL = null,
    ): self {
        $self = new self;

        $self['address'] = $address;
        $self['transportProfile'] = $transportProfile;

        null !== $certificate && $self['certificate'] = $certificate;
        null !== $serviceActivationDate && $self['serviceActivationDate'] = $serviceActivationDate;
        null !== $serviceDescription && $self['serviceDescription'] = $serviceDescription;
        null !== $serviceExpirationDate && $self['serviceExpirationDate'] = $serviceExpirationDate;
        null !== $technicalContactURL && $self['technicalContactURL'] = $technicalContactURL;
        null !== $technicalInformationURL && $self['technicalInformationURL'] = $technicalInformationURL;

        return $self;
    }

    /**
     * URL or address of the endpoint.
     */
    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * Transport profile used by this endpoint.
     */
    public function withTransportProfile(string $transportProfile): self
    {
        $self = clone $this;
        $self['transportProfile'] = $transportProfile;

        return $self;
    }

    /**
     * Certificate information for a Peppol endpoint.
     *
     * @param Certificate|array{
     *   status: string, details?: array<string,mixed>|null, error?: string|null
     * }|null $certificate
     */
    public function withCertificate(Certificate|array|null $certificate): self
    {
        $self = clone $this;
        $self['certificate'] = $certificate;

        return $self;
    }

    /**
     * ISO 8601 date when the service was activated.
     */
    public function withServiceActivationDate(
        ?string $serviceActivationDate
    ): self {
        $self = clone $this;
        $self['serviceActivationDate'] = $serviceActivationDate;

        return $self;
    }

    /**
     * Human-readable description of the service.
     */
    public function withServiceDescription(?string $serviceDescription): self
    {
        $self = clone $this;
        $self['serviceDescription'] = $serviceDescription;

        return $self;
    }

    /**
     * ISO 8601 date when the service will expire.
     */
    public function withServiceExpirationDate(
        ?string $serviceExpirationDate
    ): self {
        $self = clone $this;
        $self['serviceExpirationDate'] = $serviceExpirationDate;

        return $self;
    }

    /**
     * URL for technical contact information.
     */
    public function withTechnicalContactURL(?string $technicalContactURL): self
    {
        $self = clone $this;
        $self['technicalContactURL'] = $technicalContactURL;

        return $self;
    }

    /**
     * URL for technical documentation.
     */
    public function withTechnicalInformationURL(
        ?string $technicalInformationURL
    ): self {
        $self = clone $this;
        $self['technicalInformationURL'] = $technicalInformationURL;

        return $self;
    }
}
