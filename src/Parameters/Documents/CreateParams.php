<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Parameters\Documents\CreateParams\Item;
use EInvoiceAPI\Parameters\Documents\CreateParams\TaxDetail;

final class CreateParams implements BaseModel
{
    use Model;
    use Params;

    #[Api('amount_due', optional: true)]
    public null|float|string $amountDue;

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
    public null|float|string $invoiceTotal;

    /** @var null|list<Item> $items */
    #[Api(type: new UnionOf([new ListOf(Item::class), 'null']), optional: true)]
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

    #[Api('previous_unpaid_balance', optional: true)]
    public null|float|string $previousUnpaidBalance;

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
    public null|float|string $subtotal;

    /** @var null|list<TaxDetail> $taxDetails */
    #[Api(
        'tax_details',
        type: new UnionOf([new ListOf(TaxDetail::class), 'null']),
        optional: true,
    )]
    public ?array $taxDetails;

    #[Api('total_discount', optional: true)]
    public null|float|string $totalDiscount;

    #[Api('total_tax', optional: true)]
    public null|float|string $totalTax;

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
     * @param null|list<DocumentAttachmentCreate> $attachments
     * @param null|list<Item>                     $items
     * @param null|list<PaymentDetailCreate>      $paymentDetails
     * @param null|list<TaxDetail>                $taxDetails
     */
    final public function __construct(
        null|float|string $amountDue = null,
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
        null|float|string $invoiceTotal = null,
        ?array $items = null,
        ?string $note = null,
        ?array $paymentDetails = null,
        ?string $paymentTerm = null,
        null|float|string $previousUnpaidBalance = null,
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
        null|float|string $subtotal = null,
        ?array $taxDetails = null,
        null|float|string $totalDiscount = null,
        null|float|string $totalTax = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
    ) {
        $this->amountDue = $amountDue;
        $this->attachments = $attachments;
        $this->billingAddress = $billingAddress;
        $this->billingAddressRecipient = $billingAddressRecipient;
        $this->currency = $currency;
        $this->customerAddress = $customerAddress;
        $this->customerAddressRecipient = $customerAddressRecipient;
        $this->customerEmail = $customerEmail;
        $this->customerID = $customerID;
        $this->customerName = $customerName;
        $this->customerTaxID = $customerTaxID;
        $this->direction = $direction;
        $this->documentType = $documentType;
        $this->dueDate = $dueDate;
        $this->invoiceDate = $invoiceDate;
        $this->invoiceID = $invoiceID;
        $this->invoiceTotal = $invoiceTotal;
        $this->items = $items;
        $this->note = $note;
        $this->paymentDetails = $paymentDetails;
        $this->paymentTerm = $paymentTerm;
        $this->previousUnpaidBalance = $previousUnpaidBalance;
        $this->purchaseOrder = $purchaseOrder;
        $this->remittanceAddress = $remittanceAddress;
        $this->remittanceAddressRecipient = $remittanceAddressRecipient;
        $this->serviceAddress = $serviceAddress;
        $this->serviceAddressRecipient = $serviceAddressRecipient;
        $this->serviceEndDate = $serviceEndDate;
        $this->serviceStartDate = $serviceStartDate;
        $this->shippingAddress = $shippingAddress;
        $this->shippingAddressRecipient = $shippingAddressRecipient;
        $this->state = $state;
        $this->subtotal = $subtotal;
        $this->taxDetails = $taxDetails;
        $this->totalDiscount = $totalDiscount;
        $this->totalTax = $totalTax;
        $this->vendorAddress = $vendorAddress;
        $this->vendorAddressRecipient = $vendorAddressRecipient;
        $this->vendorEmail = $vendorEmail;
        $this->vendorName = $vendorName;
        $this->vendorTaxID = $vendorTaxID;
    }
}

CreateParams::_loadMetadata();
