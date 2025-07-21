<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\Certificate;

/**
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

    #[Api]
    public string $address;

    #[Api]
    public string $transportProfile;

    #[Api(optional: true)]
    public ?Certificate $certificate;

    #[Api(optional: true)]
    public ?string $serviceActivationDate;

    #[Api(optional: true)]
    public ?string $serviceDescription;

    #[Api(optional: true)]
    public ?string $serviceExpirationDate;

    #[Api('technicalContactUrl', optional: true)]
    public ?string $technicalContactURL;

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
