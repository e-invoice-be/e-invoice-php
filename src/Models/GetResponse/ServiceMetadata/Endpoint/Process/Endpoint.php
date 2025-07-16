<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse\ServiceMetadata\Endpoint\Process;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string      $address                 `required`
     * @param string      $transportProfile        `required`
     * @param Certificate $certificate
     * @param null|string $serviceActivationDate
     * @param null|string $serviceDescription
     * @param null|string $serviceExpirationDate
     * @param null|string $technicalContactURL
     * @param null|string $technicalInformationURL
     */
    final public function __construct(
        $address,
        $transportProfile,
        $certificate = None::NOT_GIVEN,
        $serviceActivationDate = None::NOT_GIVEN,
        $serviceDescription = None::NOT_GIVEN,
        $serviceExpirationDate = None::NOT_GIVEN,
        $technicalContactURL = None::NOT_GIVEN,
        $technicalInformationURL = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Endpoint::_loadMetadata();
