<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class PaymentDetail implements BaseModel
{
    use Model;

    #[Api('bank_account_number', optional: true)]
    public ?string $bankAccountNumber;

    #[Api(optional: true)]
    public ?string $iban;

    #[Api('payment_reference', optional: true)]
    public ?string $paymentReference;

    #[Api(optional: true)]
    public ?string $swift;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|string $bankAccountNumber
     * @param null|string $iban
     * @param null|string $paymentReference
     * @param null|string $swift
     */
    final public function __construct(
        $bankAccountNumber = None::NOT_GIVEN,
        $iban = None::NOT_GIVEN,
        $paymentReference = None::NOT_GIVEN,
        $swift = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

PaymentDetail::_loadMetadata();
