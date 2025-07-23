<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\Certificate;

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

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        string $address,
        string $transportProfile,
        ?Certificate $certificate = null,
        ?string $serviceActivationDate = null,
        ?string $serviceDescription = null,
        ?string $serviceExpirationDate = null,
        ?string $technicalContactURL = null,
        ?string $technicalInformationURL = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->address = $address;
        $this->transportProfile = $transportProfile;

        null !== $certificate && $this->certificate = $certificate;
        null !== $serviceActivationDate && $this
            ->serviceActivationDate = $serviceActivationDate
        ;
        null !== $serviceDescription && $this
            ->serviceDescription = $serviceDescription
        ;
        null !== $serviceExpirationDate && $this
            ->serviceExpirationDate = $serviceExpirationDate
        ;
        null !== $technicalContactURL && $this
            ->technicalContactURL = $technicalContactURL
        ;
        null !== $technicalInformationURL && $this
            ->technicalInformationURL = $technicalInformationURL;
    }
}
