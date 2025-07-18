<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

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
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?string $bankAccountNumber = null,
        ?string $iban = null,
        ?string $paymentReference = null,
        ?string $swift = null,
    ) {
        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $bankAccountNumber && $this
            ->bankAccountNumber = $bankAccountNumber
        ;
        null !== $iban && $this->iban = $iban;
        null !== $paymentReference && $this->paymentReference = $paymentReference;
        null !== $swift && $this->swift = $swift;
    }
}
