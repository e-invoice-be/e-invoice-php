<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\DocumentResponse\Item;
use EInvoiceAPI\Models\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Models\DocumentResponse\TaxDetail;
use EInvoiceAPI\Models\Documents\DocumentAttachment;

final class DocumentResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('amount_due', optional: true)]
    public ?string $amountDue;

    /** @var null|list<DocumentAttachment> $attachments */
    #[Api(type: new ListOf(DocumentAttachment::class), optional: true)]
    public ?array $attachments = [];

    #[Api('billing_address', optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', optional: true)]
    public ?string $billingAddressRecipient;

    /** @var null|CurrencyCode::* $currency */
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

    /** @var null|DocumentDirection::* $direction */
    #[Api(optional: true)]
    public ?string $direction;

    /** @var null|DocumentType::* $documentType */
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
    public ?array $items = [];

    #[Api(optional: true)]
    public ?string $note;

    /** @var null|list<PaymentDetail> $paymentDetails */
    #[Api(
        'payment_details',
        type: new ListOf(PaymentDetail::class),
        optional: true
    )]
    public ?array $paymentDetails = [];

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

    /** @var null|DocumentState::* $state */
    #[Api(optional: true)]
    public ?string $state;

    #[Api(optional: true)]
    public ?string $subtotal;

    /** @var null|list<TaxDetail> $taxDetails */
    #[Api('tax_details', type: new ListOf(TaxDetail::class), optional: true)]
    public ?array $taxDetails = [];

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
     * You must use named parameters to construct this object.
     *
     * @param null|list<DocumentAttachment> $attachments
     * @param CurrencyCode::*               $currency
     * @param DocumentDirection::*          $direction
     * @param DocumentType::*               $documentType
     * @param null|list<Item>               $items
     * @param null|list<PaymentDetail>      $paymentDetails
     * @param DocumentState::*              $state
     * @param null|list<TaxDetail>          $taxDetails
     */
    final public function __construct(
        string $id,
        ?string $amountDue = null,
        ?array $attachments = null,
        ?string $billingAddress = null,
        ?string $billingAddressRecipient = null,
        ?string $currency = null,
        ?string $customerAddress = null,
        ?string $customerAddressRecipient = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?string $customerName = null,
        ?string $customerTaxID = null,
        ?string $direction = null,
        ?string $documentType = null,
        ?\DateTimeInterface $dueDate = null,
        ?\DateTimeInterface $invoiceDate = null,
        ?string $invoiceID = null,
        ?string $invoiceTotal = null,
        ?array $items = null,
        ?string $note = null,
        ?array $paymentDetails = null,
        ?string $paymentTerm = null,
        ?string $previousUnpaidBalance = null,
        ?string $purchaseOrder = null,
        ?string $remittanceAddress = null,
        ?string $remittanceAddressRecipient = null,
        ?string $serviceAddress = null,
        ?string $serviceAddressRecipient = null,
        ?\DateTimeInterface $serviceEndDate = null,
        ?\DateTimeInterface $serviceStartDate = null,
        ?string $shippingAddress = null,
        ?string $shippingAddressRecipient = null,
        ?string $state = null,
        ?string $subtotal = null,
        ?array $taxDetails = null,
        ?string $totalDiscount = null,
        ?string $totalTax = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->id = $id;

        null !== $amountDue && $this->amountDue = $amountDue;
        null !== $attachments && $this->attachments = $attachments;
        null !== $billingAddress && $this->billingAddress = $billingAddress;
        null !== $billingAddressRecipient && $this
            ->billingAddressRecipient = $billingAddressRecipient
        ;
        null !== $currency && $this->currency = $currency;
        null !== $customerAddress && $this->customerAddress = $customerAddress;
        null !== $customerAddressRecipient && $this
            ->customerAddressRecipient = $customerAddressRecipient
        ;
        null !== $customerEmail && $this->customerEmail = $customerEmail;
        null !== $customerID && $this->customerID = $customerID;
        null !== $customerName && $this->customerName = $customerName;
        null !== $customerTaxID && $this->customerTaxID = $customerTaxID;
        null !== $direction && $this->direction = $direction;
        null !== $documentType && $this->documentType = $documentType;
        null !== $dueDate && $this->dueDate = $dueDate;
        null !== $invoiceDate && $this->invoiceDate = $invoiceDate;
        null !== $invoiceID && $this->invoiceID = $invoiceID;
        null !== $invoiceTotal && $this->invoiceTotal = $invoiceTotal;
        null !== $items && $this->items = $items;
        null !== $note && $this->note = $note;
        null !== $paymentDetails && $this->paymentDetails = $paymentDetails;
        null !== $paymentTerm && $this->paymentTerm = $paymentTerm;
        null !== $previousUnpaidBalance && $this
            ->previousUnpaidBalance = $previousUnpaidBalance
        ;
        null !== $purchaseOrder && $this->purchaseOrder = $purchaseOrder;
        null !== $remittanceAddress && $this
            ->remittanceAddress = $remittanceAddress
        ;
        null !== $remittanceAddressRecipient && $this
            ->remittanceAddressRecipient = $remittanceAddressRecipient
        ;
        null !== $serviceAddress && $this->serviceAddress = $serviceAddress;
        null !== $serviceAddressRecipient && $this
            ->serviceAddressRecipient = $serviceAddressRecipient
        ;
        null !== $serviceEndDate && $this->serviceEndDate = $serviceEndDate;
        null !== $serviceStartDate && $this->serviceStartDate = $serviceStartDate;
        null !== $shippingAddress && $this->shippingAddress = $shippingAddress;
        null !== $shippingAddressRecipient && $this
            ->shippingAddressRecipient = $shippingAddressRecipient
        ;
        null !== $state && $this->state = $state;
        null !== $subtotal && $this->subtotal = $subtotal;
        null !== $taxDetails && $this->taxDetails = $taxDetails;
        null !== $totalDiscount && $this->totalDiscount = $totalDiscount;
        null !== $totalTax && $this->totalTax = $totalTax;
        null !== $vendorAddress && $this->vendorAddress = $vendorAddress;
        null !== $vendorAddressRecipient && $this
            ->vendorAddressRecipient = $vendorAddressRecipient
        ;
        null !== $vendorEmail && $this->vendorEmail = $vendorEmail;
        null !== $vendorName && $this->vendorName = $vendorName;
        null !== $vendorTaxID && $this->vendorTaxID = $vendorTaxID;
    }
}
