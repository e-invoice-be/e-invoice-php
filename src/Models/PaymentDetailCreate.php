<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class PaymentDetailCreate implements BaseModel
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
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?string $bankAccountNumber = null,
        ?string $iban = null,
        ?string $paymentReference = null,
        ?string $swift = null,
    ) {
        $this->bankAccountNumber = $bankAccountNumber;
        $this->iban = $iban;
        $this->paymentReference = $paymentReference;
        $this->swift = $swift;
    }
}

PaymentDetailCreate::_loadMetadata();
