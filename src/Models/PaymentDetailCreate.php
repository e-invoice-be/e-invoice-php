<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

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
     * @param null|string $bankAccountNumber
     * @param null|string $iban
     * @param null|string $paymentReference
     * @param null|string $swift
     */
    final public function __construct(
        null|None|string $bankAccountNumber = None::NOT_SET,
        null|None|string $iban = None::NOT_SET,
        null|None|string $paymentReference = None::NOT_SET,
        null|None|string $swift = None::NOT_SET
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
