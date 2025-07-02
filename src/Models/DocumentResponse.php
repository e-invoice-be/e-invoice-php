<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
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

    #[Api('due_date', optional: true)]
    public ?\DateTimeInterface $dueDate;

    #[Api('invoice_date', optional: true)]
    public ?\DateTimeInterface $invoiceDate;

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

    #[Api('service_end_date', optional: true)]
    public ?\DateTimeInterface $serviceEndDate;

    #[Api('service_start_date', optional: true)]
    public ?\DateTimeInterface $serviceStartDate;

    #[Api('shipping_address', optional: true)]
    public ?string $shippingAddress;

    #[Api('shipping_address_recipient', optional: true)]
    public ?string $shippingAddressRecipient;

    #[Api(optional: true)]
    public string $state;

    #[Api(optional: true)]
    public ?string $subtotal;

    /**
     * @var list<array{amount?: null|string, rate?: null|string}> $taxDetails
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
     * @param null|string              $amountDue
     * @param list<DocumentAttachment> $attachments
     * @param null|string              $billingAddress
     * @param null|string              $billingAddressRecipient
     * @param string                   $currency
     * @param null|string              $customerAddress
     * @param null|string              $customerAddressRecipient
     * @param null|string              $customerEmail
     * @param null|string              $customerID
     * @param null|string              $customerName
     * @param null|string              $customerTaxID
     * @param string                   $direction
     * @param string                   $documentType
     * @param null|\DateTimeInterface  $dueDate
     * @param null|\DateTimeInterface  $invoiceDate
     * @param null|string              $invoiceID
     * @param null|string              $invoiceTotal
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
     * @param null|string $note
     * @param list<array{
     *
     *     bankAccountNumber?: string|null,
     *     iban?: string|null,
     *     paymentReference?: string|null,
     *     swift?: string|null,
     *
     * }> $paymentDetails
     * @param null|string                                           $paymentTerm
     * @param null|string                                           $previousUnpaidBalance
     * @param null|string                                           $purchaseOrder
     * @param null|string                                           $remittanceAddress
     * @param null|string                                           $remittanceAddressRecipient
     * @param null|string                                           $serviceAddress
     * @param null|string                                           $serviceAddressRecipient
     * @param null|\DateTimeInterface                               $serviceEndDate
     * @param null|\DateTimeInterface                               $serviceStartDate
     * @param null|string                                           $shippingAddress
     * @param null|string                                           $shippingAddressRecipient
     * @param string                                                $state
     * @param null|string                                           $subtotal
     * @param list<array{amount?: null|string, rate?: null|string}> $taxDetails
     * @param null|string                                           $totalDiscount
     * @param null|string                                           $totalTax
     * @param null|string                                           $vendorAddress
     * @param null|string                                           $vendorAddressRecipient
     * @param null|string                                           $vendorEmail
     * @param null|string                                           $vendorName
     * @param null|string                                           $vendorTaxID
     */
    final public function __construct(
        string $id,
        null|None|string $amountDue = None::NOT_SET,
        array|None $attachments = None::NOT_SET,
        null|None|string $billingAddress = None::NOT_SET,
        null|None|string $billingAddressRecipient = None::NOT_SET,
        None|string $currency = None::NOT_SET,
        null|None|string $customerAddress = None::NOT_SET,
        null|None|string $customerAddressRecipient = None::NOT_SET,
        null|None|string $customerEmail = None::NOT_SET,
        null|None|string $customerID = None::NOT_SET,
        null|None|string $customerName = None::NOT_SET,
        null|None|string $customerTaxID = None::NOT_SET,
        None|string $direction = None::NOT_SET,
        None|string $documentType = None::NOT_SET,
        null|\DateTimeInterface|None $dueDate = None::NOT_SET,
        null|\DateTimeInterface|None $invoiceDate = None::NOT_SET,
        null|None|string $invoiceID = None::NOT_SET,
        null|None|string $invoiceTotal = None::NOT_SET,
        array|None $items = None::NOT_SET,
        null|None|string $note = None::NOT_SET,
        array|None $paymentDetails = None::NOT_SET,
        null|None|string $paymentTerm = None::NOT_SET,
        null|None|string $previousUnpaidBalance = None::NOT_SET,
        null|None|string $purchaseOrder = None::NOT_SET,
        null|None|string $remittanceAddress = None::NOT_SET,
        null|None|string $remittanceAddressRecipient = None::NOT_SET,
        null|None|string $serviceAddress = None::NOT_SET,
        null|None|string $serviceAddressRecipient = None::NOT_SET,
        null|\DateTimeInterface|None $serviceEndDate = None::NOT_SET,
        null|\DateTimeInterface|None $serviceStartDate = None::NOT_SET,
        null|None|string $shippingAddress = None::NOT_SET,
        null|None|string $shippingAddressRecipient = None::NOT_SET,
        None|string $state = None::NOT_SET,
        null|None|string $subtotal = None::NOT_SET,
        array|None $taxDetails = None::NOT_SET,
        null|None|string $totalDiscount = None::NOT_SET,
        null|None|string $totalTax = None::NOT_SET,
        null|None|string $vendorAddress = None::NOT_SET,
        null|None|string $vendorAddressRecipient = None::NOT_SET,
        null|None|string $vendorEmail = None::NOT_SET,
        null|None|string $vendorName = None::NOT_SET,
        null|None|string $vendorTaxID = None::NOT_SET
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
