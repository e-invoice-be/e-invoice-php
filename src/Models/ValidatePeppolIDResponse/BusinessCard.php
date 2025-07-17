<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\ValidatePeppolIDResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class BusinessCard implements BaseModel
{
    use Model;

    #[Api('country_code', optional: true)]
    public ?string $countryCode;

    #[Api(optional: true)]
    public ?string $name;

    #[Api('registration_date', optional: true)]
    public ?\DateTimeInterface $registrationDate;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?string $countryCode = null,
        ?string $name = null,
        ?\DateTimeInterface $registrationDate = null,
    ) {
        $this->countryCode = $countryCode;
        $this->name = $name;
        $this->registrationDate = $registrationDate;
    }
}

BusinessCard::__introspect();
