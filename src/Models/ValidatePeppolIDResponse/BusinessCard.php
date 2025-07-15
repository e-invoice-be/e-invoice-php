<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\ValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

class BusinessCard implements BaseModel
{
    use Model;

    #[Api('country_code', optional: true)]
    public ?string $countryCode;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('registration_date', optional: true)]
    public ?\DateTimeInterface $registrationDate;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|string             $countryCode
     * @param null|string             $name
     * @param null|\DateTimeInterface $registrationDate
     */
    final public function __construct(
        $countryCode = None::NOT_GIVEN,
        $name = None::NOT_GIVEN,
        $registrationDate = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

BusinessCard::_loadMetadata();
