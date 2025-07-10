<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;

class DocumentCreate implements BaseModel
{
    use Model;

    /** @var null|float|string $amountDue */
    #[Api('amount_due', optional: true)]
    public mixed $amountDue;

    /** @var null|list<DocumentAttachmentCreate> $attachments */
    #[Api(
        type: new UnionOf([new ListOf(DocumentAttachmentCreate::class), 'null']),
        optional: true,
    )]
    public ?array $attachments;

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

    /** @var null|float|string $invoiceTotal */
    #[Api('invoice_total', optional: true)]
    public mixed $invoiceTotal;

    /**
     * @var list<array{
     *   amount?: float|string|null,
     *   date?: mixed|null,
     *   description?: string|null,
     *   productCode?: string|null,
     *   quantity?: float|string|null,
     *   tax?: float|string|null,
     *   taxRate?: string|null,
     *   unit?: string,
     *   unitPrice?: float|string|null,
     * }>|null $items
     */
    #[Api(
        type: new UnionOf([new ListOf(new ListOf('mixed')), 'null']),
        optional: true
    )]
    public ?array $items;

    #[Api(optional: true)]
    public ?string $note;

    /** @var null|list<PaymentDetailCreate> $paymentDetails */
    #[Api(
        'payment_details',
        type: new UnionOf([new ListOf(PaymentDetailCreate::class), 'null']),
        optional: true,
    )]
    public ?array $paymentDetails;

    #[Api('payment_term', optional: true)]
    public ?string $paymentTerm;

    /** @var null|float|string $previousUnpaidBalance */
    #[Api('previous_unpaid_balance', optional: true)]
    public mixed $previousUnpaidBalance;

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

    /** @var null|float|string $subtotal */
    #[Api(optional: true)]
    public mixed $subtotal;

    /**
     * @var list<array{
     *   amount?: float|string|null, rate?: string|null
     * }>|null $taxDetails
     */
    #[Api(
        'tax_details',
        type: new UnionOf([new ListOf(new ListOf('mixed')), 'null']),
        optional: true,
    )]
    public ?array $taxDetails;

    /** @var null|float|string $totalDiscount */
    #[Api('total_discount', optional: true)]
    public mixed $totalDiscount;

    /** @var null|float|string $totalTax */
    #[Api('total_tax', optional: true)]
    public mixed $totalTax;

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
     * @param null|float|string                   $amountDue
     * @param null|list<DocumentAttachmentCreate> $attachments
     * @param null|string                         $billingAddress
     * @param null|string                         $billingAddressRecipient
     * @param string                              $currency
     * @param null|string                         $customerAddress
     * @param null|string                         $customerAddressRecipient
     * @param null|string                         $customerEmail
     * @param null|string                         $customerID
     * @param null|string                         $customerName
     * @param null|string                         $customerTaxID
     * @param string                              $direction
     * @param string                              $documentType
     * @param null|\DateTimeInterface             $dueDate
     * @param null|\DateTimeInterface             $invoiceDate
     * @param null|string                         $invoiceID
     * @param null|float|string                   $invoiceTotal
     * @param list<array{
     *   amount?: float|string|null,
     *   date?: mixed|null,
     *   description?: string|null,
     *   productCode?: string|null,
     *   quantity?: float|string|null,
     *   tax?: float|string|null,
     *   taxRate?: string|null,
     *   unit?: string,
     *   unitPrice?: float|string|null,
     * }>|null $items
     * @param null|string                    $note
     * @param null|list<PaymentDetailCreate> $paymentDetails
     * @param null|string                    $paymentTerm
     * @param null|float|string              $previousUnpaidBalance
     * @param null|string                    $purchaseOrder
     * @param null|string                    $remittanceAddress
     * @param null|string                    $remittanceAddressRecipient
     * @param null|string                    $serviceAddress
     * @param null|string                    $serviceAddressRecipient
     * @param null|\DateTimeInterface        $serviceEndDate
     * @param null|\DateTimeInterface        $serviceStartDate
     * @param null|string                    $shippingAddress
     * @param null|string                    $shippingAddressRecipient
     * @param string                         $state
     * @param null|float|string              $subtotal
     * @param list<array{
     *   amount?: float|string|null, rate?: string|null
     * }>|null $taxDetails
     * @param null|float|string $totalDiscount
     * @param null|float|string $totalTax
     * @param null|string       $vendorAddress
     * @param null|string       $vendorAddressRecipient
     * @param null|string       $vendorEmail
     * @param null|string       $vendorName
     * @param null|string       $vendorTaxID
     */
    final public function __construct(
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

DocumentCreate::_loadMetadata();
