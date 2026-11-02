<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type PaymentDetailCreateShape = array{
 *   bankAccountNumber?: string|null,
 *   iban?: string|null,
 *   paymentReference?: string|null,
 *   swift?: string|null,
 * }
 */
final class PaymentDetailCreate implements BaseModel
{
    /** @use SdkModel<PaymentDetailCreateShape> */
    use SdkModel;

    /**
     * Bank account number (for non-IBAN accounts). With `swift` `SE:BANKGIRO` or `SE:PLUSGIRO`, the bankgiro or plusgiro number, with `iban` left empty; spaces and hyphens are removed.
     */
    #[Optional('bank_account_number', nullable: true)]
    public ?string $bankAccountNumber;

    /**
     * International Bank Account Number for payment transfers.
     */
    #[Optional(nullable: true)]
    public ?string $iban;

    /**
     * Structured payment reference or communication (e.g., structured communication for Belgian bank transfers).
     */
    #[Optional('payment_reference', nullable: true)]
    public ?string $paymentReference;

    /**
     * The payment service provider identifier (BT-86): the BIC of the payee's bank, or `SE:BANKGIRO` / `SE:PLUSGIRO` when `bank_account_number` is a Swedish bankgiro or plusgiro number.
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
        ?string $bankAccountNumber = null,
        ?string $iban = null,
        ?string $paymentReference = null,
        ?string $swift = null,
    ): self {
        $self = new self;

        null !== $bankAccountNumber && $self['bankAccountNumber'] = $bankAccountNumber;
        null !== $iban && $self['iban'] = $iban;
        null !== $paymentReference && $self['paymentReference'] = $paymentReference;
        null !== $swift && $self['swift'] = $swift;

        return $self;
    }

    /**
     * Bank account number (for non-IBAN accounts). With `swift` `SE:BANKGIRO` or `SE:PLUSGIRO`, the bankgiro or plusgiro number, with `iban` left empty; spaces and hyphens are removed.
     */
    public function withBankAccountNumber(?string $bankAccountNumber): self
    {
        $self = clone $this;
        $self['bankAccountNumber'] = $bankAccountNumber;

        return $self;
    }

    /**
     * International Bank Account Number for payment transfers.
     */
    public function withIban(?string $iban): self
    {
        $self = clone $this;
        $self['iban'] = $iban;

        return $self;
    }

    /**
     * Structured payment reference or communication (e.g., structured communication for Belgian bank transfers).
     */
    public function withPaymentReference(?string $paymentReference): self
    {
        $self = clone $this;
        $self['paymentReference'] = $paymentReference;

        return $self;
    }

    /**
     * The payment service provider identifier (BT-86): the BIC of the payee's bank, or `SE:BANKGIRO` / `SE:PLUSGIRO` when `bank_account_number` is a Swedish bankgiro or plusgiro number.
     */
    public function withSwift(?string $swift): self
    {
        $self = clone $this;
        $self['swift'] = $swift;

        return $self;
    }
}
