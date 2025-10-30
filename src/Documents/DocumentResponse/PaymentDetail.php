<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaymentDetailShape = array{
 *   bankAccountNumber?: string|null,
 *   iban?: string|null,
 *   paymentReference?: string|null,
 *   swift?: string|null,
 * }
 */
final class PaymentDetail implements BaseModel
{
    /** @use SdkModel<PaymentDetailShape> */
    use SdkModel;

    #[Api('bank_account_number', nullable: true, optional: true)]
    public ?string $bankAccountNumber;

    #[Api(nullable: true, optional: true)]
    public ?string $iban;

    #[Api('payment_reference', nullable: true, optional: true)]
    public ?string $paymentReference;

    #[Api(nullable: true, optional: true)]
    public ?string $swift;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(
        ?string $bankAccountNumber = null,
        ?string $iban = null,
        ?string $paymentReference = null,
        ?string $swift = null,
    ): self {
        $obj = new self;

        null !== $bankAccountNumber && $obj->bankAccountNumber = $bankAccountNumber;
        null !== $iban && $obj->iban = $iban;
        null !== $paymentReference && $obj->paymentReference = $paymentReference;
        null !== $swift && $obj->swift = $swift;

        return $obj;
    }

    public function withBankAccountNumber(?string $bankAccountNumber): self
    {
        $obj = clone $this;
        $obj->bankAccountNumber = $bankAccountNumber;

        return $obj;
    }

    public function withIban(?string $iban): self
    {
        $obj = clone $this;
        $obj->iban = $iban;

        return $obj;
    }

    public function withPaymentReference(?string $paymentReference): self
    {
        $obj = clone $this;
        $obj->paymentReference = $paymentReference;

        return $obj;
    }

    public function withSwift(?string $swift): self
    {
        $obj = clone $this;
        $obj->swift = $swift;

        return $obj;
    }
}
