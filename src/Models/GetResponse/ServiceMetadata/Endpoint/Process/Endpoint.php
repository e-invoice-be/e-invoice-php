<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\Certificate;

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
        $this->address = $address;
        $this->transportProfile = $transportProfile;
        $this->certificate = $certificate;
        $this->serviceActivationDate = $serviceActivationDate;
        $this->serviceDescription = $serviceDescription;
        $this->serviceExpirationDate = $serviceExpirationDate;
        $this->technicalContactURL = $technicalContactURL;
        $this->technicalInformationURL = $technicalInformationURL;
    }
}

Endpoint::_loadMetadata();
