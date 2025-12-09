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
 *   technicalContactUrl?: string|null,
 *   technicalInformationUrl?: string|null,
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
    #[Optional(nullable: true)]
    public ?string $technicalContactUrl;

    /**
     * URL for technical documentation.
     */
    #[Optional(nullable: true)]
    public ?string $technicalInformationUrl;

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
        ?string $technicalContactUrl = null,
        ?string $technicalInformationUrl = null,
    ): self {
        $obj = new self;

        $obj['address'] = $address;
        $obj['transportProfile'] = $transportProfile;

        null !== $certificate && $obj['certificate'] = $certificate;
        null !== $serviceActivationDate && $obj['serviceActivationDate'] = $serviceActivationDate;
        null !== $serviceDescription && $obj['serviceDescription'] = $serviceDescription;
        null !== $serviceExpirationDate && $obj['serviceExpirationDate'] = $serviceExpirationDate;
        null !== $technicalContactUrl && $obj['technicalContactUrl'] = $technicalContactUrl;
        null !== $technicalInformationUrl && $obj['technicalInformationUrl'] = $technicalInformationUrl;

        return $obj;
    }

    /**
     * URL or address of the endpoint.
     */
    public function withAddress(string $address): self
    {
        $obj = clone $this;
        $obj['address'] = $address;

        return $obj;
    }

    /**
     * Transport profile used by this endpoint.
     */
    public function withTransportProfile(string $transportProfile): self
    {
        $obj = clone $this;
        $obj['transportProfile'] = $transportProfile;

        return $obj;
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
        $obj = clone $this;
        $obj['certificate'] = $certificate;

        return $obj;
    }

    /**
     * ISO 8601 date when the service was activated.
     */
    public function withServiceActivationDate(
        ?string $serviceActivationDate
    ): self {
        $obj = clone $this;
        $obj['serviceActivationDate'] = $serviceActivationDate;

        return $obj;
    }

    /**
     * Human-readable description of the service.
     */
    public function withServiceDescription(?string $serviceDescription): self
    {
        $obj = clone $this;
        $obj['serviceDescription'] = $serviceDescription;

        return $obj;
    }

    /**
     * ISO 8601 date when the service will expire.
     */
    public function withServiceExpirationDate(
        ?string $serviceExpirationDate
    ): self {
        $obj = clone $this;
        $obj['serviceExpirationDate'] = $serviceExpirationDate;

        return $obj;
    }

    /**
     * URL for technical contact information.
     */
    public function withTechnicalContactURL(?string $technicalContactURL): self
    {
        $obj = clone $this;
        $obj['technicalContactUrl'] = $technicalContactURL;

        return $obj;
    }

    /**
     * URL for technical documentation.
     */
    public function withTechnicalInformationURL(
        ?string $technicalInformationURL
    ): self {
        $obj = clone $this;
        $obj['technicalInformationUrl'] = $technicalInformationURL;

        return $obj;
    }
}
