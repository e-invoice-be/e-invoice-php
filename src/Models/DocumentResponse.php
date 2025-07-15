<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\DocumentResponse\Item;
use EInvoiceAPI\Models\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Models\DocumentResponse\TaxDetail;
use EInvoiceAPI\Models\Documents\DocumentAttachment;

class DocumentResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('amount_due', optional: true)]
    public ?string $amountDue;

    /** @var null|list<DocumentAttachment> $attachments */
    #[Api(type: new ListOf(DocumentAttachment::class), optional: true)]
    public ?array $attachments;

    #[Api('billing_address', optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', optional: true)]
    public ?string $billingAddressRecipient;

    #[Api(optional: true)]
    public ?string $currency;

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
    public ?string $direction;

    #[Api('document_type', optional: true)]
    public ?string $documentType;

    #[Api('due_date', optional: true)]
    public ?\DateTimeInterface $dueDate;

    #[Api('invoice_date', optional: true)]
    public ?\DateTimeInterface $invoiceDate;

    #[Api('invoice_id', optional: true)]
    public ?string $invoiceID;

    #[Api('invoice_total', optional: true)]
    public ?string $invoiceTotal;

    /** @var null|list<Item> $items */
    #[Api(type: new ListOf(Item::class), optional: true)]
    public ?array $items;

    #[Api(optional: true)]
    public ?string $note;

    /** @var null|list<PaymentDetail> $paymentDetails */
    #[Api(
        'payment_details',
        type: new ListOf(PaymentDetail::class),
        optional: true
    )]
    public ?array $paymentDetails;

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
    public ?string $state;

    #[Api(optional: true)]
    public ?string $subtotal;

    /** @var null|list<TaxDetail> $taxDetails */
    #[Api('tax_details', type: new ListOf(TaxDetail::class), optional: true)]
    public ?array $taxDetails;

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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string                        $id                         `required`
     * @param null|string                   $amountDue
     * @param null|list<DocumentAttachment> $attachments
     * @param null|string                   $billingAddress
     * @param null|string                   $billingAddressRecipient
     * @param string                        $currency
     * @param null|string                   $customerAddress
     * @param null|string                   $customerAddressRecipient
     * @param null|string                   $customerEmail
     * @param null|string                   $customerID
     * @param null|string                   $customerName
     * @param null|string                   $customerTaxID
     * @param string                        $direction
     * @param string                        $documentType
     * @param null|\DateTimeInterface       $dueDate
     * @param null|\DateTimeInterface       $invoiceDate
     * @param null|string                   $invoiceID
     * @param null|string                   $invoiceTotal
     * @param null|list<Item>               $items
     * @param null|string                   $note
     * @param null|list<PaymentDetail>      $paymentDetails
     * @param null|string                   $paymentTerm
     * @param null|string                   $previousUnpaidBalance
     * @param null|string                   $purchaseOrder
     * @param null|string                   $remittanceAddress
     * @param null|string                   $remittanceAddressRecipient
     * @param null|string                   $serviceAddress
     * @param null|string                   $serviceAddressRecipient
     * @param null|\DateTimeInterface       $serviceEndDate
     * @param null|\DateTimeInterface       $serviceStartDate
     * @param null|string                   $shippingAddress
     * @param null|string                   $shippingAddressRecipient
     * @param string                        $state
     * @param null|string                   $subtotal
     * @param null|list<TaxDetail>          $taxDetails
     * @param null|string                   $totalDiscount
     * @param null|string                   $totalTax
     * @param null|string                   $vendorAddress
     * @param null|string                   $vendorAddressRecipient
     * @param null|string                   $vendorEmail
     * @param null|string                   $vendorName
     * @param null|string                   $vendorTaxID
     */
    final public function __construct(
        $id,
        $amountDue = None::NOT_GIVEN,
        $attachments = None::NOT_GIVEN,
        $billingAddress = None::NOT_GIVEN,
        $billingAddressRecipient = None::NOT_GIVEN,
        $currency = None::NOT_GIVEN,
        $customerAddress = None::NOT_GIVEN,
        $customerAddressRecipient = None::NOT_GIVEN,
        $customerEmail = None::NOT_GIVEN,
        $customerID = None::NOT_GIVEN,
        $customerName = None::NOT_GIVEN,
        $customerTaxID = None::NOT_GIVEN,
        $direction = None::NOT_GIVEN,
        $documentType = None::NOT_GIVEN,
        $dueDate = None::NOT_GIVEN,
        $invoiceDate = None::NOT_GIVEN,
        $invoiceID = None::NOT_GIVEN,
        $invoiceTotal = None::NOT_GIVEN,
        $items = None::NOT_GIVEN,
        $note = None::NOT_GIVEN,
        $paymentDetails = None::NOT_GIVEN,
        $paymentTerm = None::NOT_GIVEN,
        $previousUnpaidBalance = None::NOT_GIVEN,
        $purchaseOrder = None::NOT_GIVEN,
        $remittanceAddress = None::NOT_GIVEN,
        $remittanceAddressRecipient = None::NOT_GIVEN,
        $serviceAddress = None::NOT_GIVEN,
        $serviceAddressRecipient = None::NOT_GIVEN,
        $serviceEndDate = None::NOT_GIVEN,
        $serviceStartDate = None::NOT_GIVEN,
        $shippingAddress = None::NOT_GIVEN,
        $shippingAddressRecipient = None::NOT_GIVEN,
        $state = None::NOT_GIVEN,
        $subtotal = None::NOT_GIVEN,
        $taxDetails = None::NOT_GIVEN,
        $totalDiscount = None::NOT_GIVEN,
        $totalTax = None::NOT_GIVEN,
        $vendorAddress = None::NOT_GIVEN,
        $vendorAddressRecipient = None::NOT_GIVEN,
        $vendorEmail = None::NOT_GIVEN,
        $vendorName = None::NOT_GIVEN,
        $vendorTaxID = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

DocumentResponse::_loadMetadata();
