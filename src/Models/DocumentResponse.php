<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\Documents\DocumentAttachment;

class DocumentResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('amount_due', optional: true)]
    public ?string $amountDue;

    /**
     * @var list<DocumentAttachment> $attachments
     */
    #[Api(type: new ListOf(DocumentAttachment::class), optional: true)]
    public array $attachments;

    #[Api('billing_address', optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', optional: true)]
    public ?string $billingAddressRecipient;

    #[Api(optional: true)]
    public string $currency;

    #[Api('customer_address', optional: true)]
    public ?string $customerAddress;

    #[Api('customer_address_recipient', optional: true)]
    public ?string $customerAddressRecipient;

    #[Api('customer_email', optional: true)]
    public ?string $customerEmail;

    #[Api('customer_id', optional: true)]
    public ?string $customerID;

    #[Api('customer_name', optional: true)]
    public ?string $customerName;

    #[Api('customer_tax_id', optional: true)]
    public ?string $customerTaxID;

    #[Api(optional: true)]
    public string $direction;

    #[Api('document_type', optional: true)]
    public string $documentType;

    /**
     * @var mixed|null $dueDate
     */
    #[Api('due_date', optional: true)]
    public mixed $dueDate;

    /**
     * @var mixed|null $invoiceDate
     */
    #[Api('invoice_date', optional: true)]
    public mixed $invoiceDate;

    #[Api('invoice_id', optional: true)]
    public ?string $invoiceID;

    #[Api('invoice_total', optional: true)]
    public ?string $invoiceTotal;

    /**
     * @var list<array{
     *
     *     amount?: string|null,
     *     date?: mixed|null,
     *     description?: string|null,
     *     productCode?: string|null,
     *     quantity?: string|null,
     *     tax?: string|null,
     *     taxRate?: string|null,
     *     unit?: string,
     *     unitPrice?: string|null,
     *
     * }> $items
     */
    #[Api(type: new ListOf(new ListOf('mixed')), optional: true)]
    public array $items;

    #[Api(optional: true)]
    public ?string $note;

    /**
     * @var list<array{
     *
     *     bankAccountNumber?: string|null,
     *     iban?: string|null,
     *     paymentReference?: string|null,
     *     swift?: string|null,
     *
     * }> $paymentDetails
     */
    #[Api(
        'payment_details',
        type: new ListOf(new ListOf('mixed')),
        optional: true
    )]
    public array $paymentDetails;

    #[Api('payment_term', optional: true)]
    public ?string $paymentTerm;

    #[Api('previous_unpaid_balance', optional: true)]
    public ?string $previousUnpaidBalance;

    #[Api('purchase_order', optional: true)]
    public ?string $purchaseOrder;

    #[Api('remittance_address', optional: true)]
    public ?string $remittanceAddress;

    #[Api('remittance_address_recipient', optional: true)]
    public ?string $remittanceAddressRecipient;

    #[Api('service_address', optional: true)]
    public ?string $serviceAddress;

    #[Api('service_address_recipient', optional: true)]
    public ?string $serviceAddressRecipient;

    /**
     * @var mixed|null $serviceEndDate
     */
    #[Api('service_end_date', optional: true)]
    public mixed $serviceEndDate;

    /**
     * @var mixed|null $serviceStartDate
     */
    #[Api('service_start_date', optional: true)]
    public mixed $serviceStartDate;

    #[Api('shipping_address', optional: true)]
    public ?string $shippingAddress;

    #[Api('shipping_address_recipient', optional: true)]
    public ?string $shippingAddressRecipient;

    #[Api(optional: true)]
    public string $state;

    #[Api(optional: true)]
    public ?string $subtotal;

    /**
     * @var list<array{amount?: string|null, rate?: string|null}> $taxDetails
     */
    #[Api('tax_details', type: new ListOf(new ListOf('mixed')), optional: true)]
    public array $taxDetails;

    #[Api('total_discount', optional: true)]
    public ?string $totalDiscount;

    #[Api('total_tax', optional: true)]
    public ?string $totalTax;

    #[Api('vendor_address', optional: true)]
    public ?string $vendorAddress;

    #[Api('vendor_address_recipient', optional: true)]
    public ?string $vendorAddressRecipient;

    #[Api('vendor_email', optional: true)]
    public ?string $vendorEmail;

    #[Api('vendor_name', optional: true)]
    public ?string $vendorName;

    #[Api('vendor_tax_id', optional: true)]
    public ?string $vendorTaxID;

    /**
     * @param string|null              $amountDue
     * @param list<DocumentAttachment> $attachments
     * @param string|null              $billingAddress
     * @param string|null              $billingAddressRecipient
     * @param string                   $currency
     * @param string|null              $customerAddress
     * @param string|null              $customerAddressRecipient
     * @param string|null              $customerEmail
     * @param string|null              $customerID
     * @param string|null              $customerName
     * @param string|null              $customerTaxID
     * @param string                   $direction
     * @param string                   $documentType
     * @param mixed|null               $dueDate
     * @param mixed|null               $invoiceDate
     * @param string|null              $invoiceID
     * @param string|null              $invoiceTotal
     * @param list<array{
     *
     *     amount?: string|null,
     *     date?: mixed|null,
     *     description?: string|null,
     *     productCode?: string|null,
     *     quantity?: string|null,
     *     tax?: string|null,
     *     taxRate?: string|null,
     *     unit?: string,
     *     unitPrice?: string|null,
     *
     * }> $items
     * @param string|null $note
     * @param list<array{
     *
     *     bankAccountNumber?: string|null,
     *     iban?: string|null,
     *     paymentReference?: string|null,
     *     swift?: string|null,
     *
     * }> $paymentDetails
     * @param string|null                                           $paymentTerm
     * @param string|null                                           $previousUnpaidBalance
     * @param string|null                                           $purchaseOrder
     * @param string|null                                           $remittanceAddress
     * @param string|null                                           $remittanceAddressRecipient
     * @param string|null                                           $serviceAddress
     * @param string|null                                           $serviceAddressRecipient
     * @param mixed|null                                            $serviceEndDate
     * @param mixed|null                                            $serviceStartDate
     * @param string|null                                           $shippingAddress
     * @param string|null                                           $shippingAddressRecipient
     * @param string                                                $state
     * @param string|null                                           $subtotal
     * @param list<array{amount?: string|null, rate?: string|null}> $taxDetails
     * @param string|null                                           $totalDiscount
     * @param string|null                                           $totalTax
     * @param string|null                                           $vendorAddress
     * @param string|null                                           $vendorAddressRecipient
     * @param string|null                                           $vendorEmail
     * @param string|null                                           $vendorName
     * @param string|null                                           $vendorTaxID
     */
    final public function __construct(
        string $id,
        string|None|null $amountDue = None::NOT_SET,
        array|None $attachments = None::NOT_SET,
        string|None|null $billingAddress = None::NOT_SET,
        string|None|null $billingAddressRecipient = None::NOT_SET,
        string|None $currency = None::NOT_SET,
        string|None|null $customerAddress = None::NOT_SET,
        string|None|null $customerAddressRecipient = None::NOT_SET,
        string|None|null $customerEmail = None::NOT_SET,
        string|None|null $customerID = None::NOT_SET,
        string|None|null $customerName = None::NOT_SET,
        string|None|null $customerTaxID = None::NOT_SET,
        string|None $direction = None::NOT_SET,
        string|None $documentType = None::NOT_SET,
        mixed $dueDate = None::NOT_SET,
        mixed $invoiceDate = None::NOT_SET,
        string|None|null $invoiceID = None::NOT_SET,
        string|None|null $invoiceTotal = None::NOT_SET,
        array|None $items = None::NOT_SET,
        string|None|null $note = None::NOT_SET,
        array|None $paymentDetails = None::NOT_SET,
        string|None|null $paymentTerm = None::NOT_SET,
        string|None|null $previousUnpaidBalance = None::NOT_SET,
        string|None|null $purchaseOrder = None::NOT_SET,
        string|None|null $remittanceAddress = None::NOT_SET,
        string|None|null $remittanceAddressRecipient = None::NOT_SET,
        string|None|null $serviceAddress = None::NOT_SET,
        string|None|null $serviceAddressRecipient = None::NOT_SET,
        mixed $serviceEndDate = None::NOT_SET,
        mixed $serviceStartDate = None::NOT_SET,
        string|None|null $shippingAddress = None::NOT_SET,
        string|None|null $shippingAddressRecipient = None::NOT_SET,
        string|None $state = None::NOT_SET,
        string|None|null $subtotal = None::NOT_SET,
        array|None $taxDetails = None::NOT_SET,
        string|None|null $totalDiscount = None::NOT_SET,
        string|None|null $totalTax = None::NOT_SET,
        string|None|null $vendorAddress = None::NOT_SET,
        string|None|null $vendorAddressRecipient = None::NOT_SET,
        string|None|null $vendorEmail = None::NOT_SET,
        string|None|null $vendorName = None::NOT_SET,
        string|None|null $vendorTaxID = None::NOT_SET,
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

DocumentResponse::_loadMetadata();
