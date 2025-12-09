<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaymentDetailCreateShape = array{
 *   bank_account_number?: string|null,
 *   iban?: string|null,
 *   payment_reference?: string|null,
 *   swift?: string|null,
 * }
 */
final class PaymentDetailCreate implements BaseModel
{
    /** @use SdkModel<PaymentDetailCreateShape> */
    use SdkModel;

    /**
     * Bank account number (for non-IBAN accounts).
     */
    #[Optional(nullable: true)]
    public ?string $bank_account_number;

    /**
     * International Bank Account Number for payment transfers.
     */
    #[Optional(nullable: true)]
    public ?string $iban;

    /**
     * Structured payment reference or communication (e.g., structured communication for Belgian bank transfers).
     */
    #[Optional(nullable: true)]
    public ?string $payment_reference;

    /**
     * SWIFT/BIC code of the bank.
     */
    #[Optional(nullable: true)]
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
        ?string $bank_account_number = null,
        ?string $iban = null,
        ?string $payment_reference = null,
        ?string $swift = null,
    ): self {
        $obj = new self;

        null !== $bank_account_number && $obj['bank_account_number'] = $bank_account_number;
        null !== $iban && $obj['iban'] = $iban;
        null !== $payment_reference && $obj['payment_reference'] = $payment_reference;
        null !== $swift && $obj['swift'] = $swift;

        return $obj;
    }

    /**
     * Bank account number (for non-IBAN accounts).
     */
    public function withBankAccountNumber(?string $bankAccountNumber): self
    {
        $obj = clone $this;
        $obj['bank_account_number'] = $bankAccountNumber;

        return $obj;
    }

    /**
     * International Bank Account Number for payment transfers.
     */
    public function withIban(?string $iban): self
    {
        $obj = clone $this;
        $obj['iban'] = $iban;

        return $obj;
    }

    /**
     * Structured payment reference or communication (e.g., structured communication for Belgian bank transfers).
     */
    public function withPaymentReference(?string $paymentReference): self
    {
        $obj = clone $this;
        $obj['payment_reference'] = $paymentReference;

        return $obj;
    }

    /**
     * SWIFT/BIC code of the bank.
     */
    public function withSwift(?string $swift): self
    {
        $obj = clone $this;
        $obj['swift'] = $swift;

        return $obj;
    }
}
