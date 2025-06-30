<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

class PaymentDetailCreate implements BaseModel
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
     * @param string|null $bankAccountNumber
     * @param string|null $iban
     * @param string|null $paymentReference
     * @param string|null $swift
     */
    final public function __construct(
        string|None|null $bankAccountNumber = None::NOT_SET,
        string|None|null $iban = None::NOT_SET,
        string|None|null $paymentReference = None::NOT_SET,
        string|None|null $swift = None::NOT_SET,
    ) {

        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);

    }
}

PaymentDetailCreate::_loadMetadata();
