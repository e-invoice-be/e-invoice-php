<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\DocumentResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type payment_detail_alias = array{
 *   bankAccountNumber?: string|null,
 *   iban?: string|null,
 *   paymentReference?: string|null,
 *   swift?: string|null,
 * }
 */
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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function new(
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

    public function setBankAccountNumber(?string $bankAccountNumber): self
    {
        $this->bankAccountNumber = $bankAccountNumber;

        return $this;
    }

    public function setIban(?string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }

    public function setPaymentReference(?string $paymentReference): self
    {
        $this->paymentReference = $paymentReference;

        return $this;
    }

    public function setSwift(?string $swift): self
    {
        $this->swift = $swift;

        return $this;
    }
}
