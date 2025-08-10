<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Models\DocumentCreate\Item;
use EInvoiceAPI\Models\DocumentCreate\TaxDetail;

/**
 * @phpstan-type document_create_alias = array{
 *   amountDue?: float|string|null,
 *   attachments?: list<DocumentAttachmentCreate>|null,
 *   billingAddress?: string|null,
 *   billingAddressRecipient?: string|null,
 *   currency?: CurrencyCode::*,
 *   customerAddress?: string|null,
 *   customerAddressRecipient?: string|null,
 *   customerEmail?: string|null,
 *   customerID?: string|null,
 *   customerName?: string|null,
 *   customerTaxID?: string|null,
 *   direction?: DocumentDirection::*,
 *   documentType?: DocumentType::*,
 *   dueDate?: \DateTimeInterface|null,
 *   invoiceDate?: \DateTimeInterface|null,
 *   invoiceID?: string|null,
 *   invoiceTotal?: float|string|null,
 *   items?: list<Item>|null,
 *   note?: string|null,
 *   paymentDetails?: list<PaymentDetailCreate>|null,
 *   paymentTerm?: string|null,
 *   previousUnpaidBalance?: float|string|null,
 *   purchaseOrder?: string|null,
 *   remittanceAddress?: string|null,
 *   remittanceAddressRecipient?: string|null,
 *   serviceAddress?: string|null,
 *   serviceAddressRecipient?: string|null,
 *   serviceEndDate?: \DateTimeInterface|null,
 *   serviceStartDate?: \DateTimeInterface|null,
 *   shippingAddress?: string|null,
 *   shippingAddressRecipient?: string|null,
 *   state?: DocumentState::*,
 *   subtotal?: float|string|null,
 *   taxDetails?: list<TaxDetail>|null,
 *   totalDiscount?: float|string|null,
 *   totalTax?: float|string|null,
 *   vendorAddress?: string|null,
 *   vendorAddressRecipient?: string|null,
 *   vendorEmail?: string|null,
 *   vendorName?: string|null,
 *   vendorTaxID?: string|null,
 * }
 */
final class DocumentCreate implements BaseModel
{
    use Model;

    #[Api('amount_due', optional: true)]
    public null|float|string $amountDue;

    /** @var null|list<DocumentAttachmentCreate> $attachments */
    #[Api(
        type: new ListOf(DocumentAttachmentCreate::class),
        nullable: true,
        optional: true,
    )]
    public ?array $attachments;

    #[Api('billing_address', optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', optional: true)]
    public ?string $billingAddressRecipient;

    /**
     * Currency of the invoice.
     *
     * @var null|CurrencyCode::* $currency
     */
    #[Api(enum: CurrencyCode::class, optional: true)]
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
    #[Api(enum: DocumentDirection::class, optional: true)]
    public ?string $direction;

    /** @var null|DocumentType::* $documentType */
    #[Api('document_type', enum: DocumentType::class, optional: true)]
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
    #[Api(type: new ListOf(Item::class), nullable: true, optional: true)]
    public ?array $items;

    #[Api(optional: true)]
    public ?string $note;

    /** @var null|list<PaymentDetailCreate> $paymentDetails */
    #[Api(
        'payment_details',
        type: new ListOf(PaymentDetailCreate::class),
        nullable: true,
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

    /** @var null|DocumentState::* $state */
    #[Api(enum: DocumentState::class, optional: true)]
    public ?string $state;

    #[Api(optional: true)]
    public null|float|string $subtotal;

    /** @var null|list<TaxDetail> $taxDetails */
    #[Api(
        'tax_details',
        type: new ListOf(TaxDetail::class),
        nullable: true,
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

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<DocumentAttachmentCreate> $attachments
     * @param CurrencyCode::* $currency
     * @param DocumentDirection::* $direction
     * @param DocumentType::* $documentType
     * @param null|list<Item> $items
     * @param null|list<PaymentDetailCreate> $paymentDetails
     * @param DocumentState::* $state
     * @param null|list<TaxDetail> $taxDetails
     */
    public static function new(
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
    ): self {
        $obj = new self;

        null !== $amountDue && $obj->amountDue = $amountDue;
        null !== $attachments && $obj->attachments = $attachments;
        null !== $billingAddress && $obj->billingAddress = $billingAddress;
        null !== $billingAddressRecipient && $obj->billingAddressRecipient = $billingAddressRecipient;
        null !== $currency && $obj->currency = $currency;
        null !== $customerAddress && $obj->customerAddress = $customerAddress;
        null !== $customerAddressRecipient && $obj->customerAddressRecipient = $customerAddressRecipient;
        null !== $customerEmail && $obj->customerEmail = $customerEmail;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $customerName && $obj->customerName = $customerName;
        null !== $customerTaxID && $obj->customerTaxID = $customerTaxID;
        null !== $direction && $obj->direction = $direction;
        null !== $documentType && $obj->documentType = $documentType;
        null !== $dueDate && $obj->dueDate = $dueDate;
        null !== $invoiceDate && $obj->invoiceDate = $invoiceDate;
        null !== $invoiceID && $obj->invoiceID = $invoiceID;
        null !== $invoiceTotal && $obj->invoiceTotal = $invoiceTotal;
        null !== $items && $obj->items = $items;
        null !== $note && $obj->note = $note;
        null !== $paymentDetails && $obj->paymentDetails = $paymentDetails;
        null !== $paymentTerm && $obj->paymentTerm = $paymentTerm;
        null !== $previousUnpaidBalance && $obj->previousUnpaidBalance = $previousUnpaidBalance;
        null !== $purchaseOrder && $obj->purchaseOrder = $purchaseOrder;
        null !== $remittanceAddress && $obj->remittanceAddress = $remittanceAddress;
        null !== $remittanceAddressRecipient && $obj->remittanceAddressRecipient = $remittanceAddressRecipient;
        null !== $serviceAddress && $obj->serviceAddress = $serviceAddress;
        null !== $serviceAddressRecipient && $obj->serviceAddressRecipient = $serviceAddressRecipient;
        null !== $serviceEndDate && $obj->serviceEndDate = $serviceEndDate;
        null !== $serviceStartDate && $obj->serviceStartDate = $serviceStartDate;
        null !== $shippingAddress && $obj->shippingAddress = $shippingAddress;
        null !== $shippingAddressRecipient && $obj->shippingAddressRecipient = $shippingAddressRecipient;
        null !== $state && $obj->state = $state;
        null !== $subtotal && $obj->subtotal = $subtotal;
        null !== $taxDetails && $obj->taxDetails = $taxDetails;
        null !== $totalDiscount && $obj->totalDiscount = $totalDiscount;
        null !== $totalTax && $obj->totalTax = $totalTax;
        null !== $vendorAddress && $obj->vendorAddress = $vendorAddress;
        null !== $vendorAddressRecipient && $obj->vendorAddressRecipient = $vendorAddressRecipient;
        null !== $vendorEmail && $obj->vendorEmail = $vendorEmail;
        null !== $vendorName && $obj->vendorName = $vendorName;
        null !== $vendorTaxID && $obj->vendorTaxID = $vendorTaxID;

        return $obj;
    }

    public function setAmountDue(null|float|string $amountDue): self
    {
        $this->amountDue = $amountDue;

        return $this;
    }

    /**
     * @param null|list<DocumentAttachmentCreate> $attachments
     */
    public function setAttachments(?array $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }

    public function setBillingAddress(?string $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    public function setBillingAddressRecipient(
        ?string $billingAddressRecipient
    ): self {
        $this->billingAddressRecipient = $billingAddressRecipient;

        return $this;
    }

    /**
     * Currency of the invoice.
     *
     * @param CurrencyCode::* $currency
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function setCustomerAddress(?string $customerAddress): self
    {
        $this->customerAddress = $customerAddress;

        return $this;
    }

    public function setCustomerAddressRecipient(
        ?string $customerAddressRecipient
    ): self {
        $this->customerAddressRecipient = $customerAddressRecipient;

        return $this;
    }

    public function setCustomerEmail(?string $customerEmail): self
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    public function setCustomerID(?string $customerID): self
    {
        $this->customerID = $customerID;

        return $this;
    }

    public function setCustomerName(?string $customerName): self
    {
        $this->customerName = $customerName;

        return $this;
    }

    public function setCustomerTaxID(?string $customerTaxID): self
    {
        $this->customerTaxID = $customerTaxID;

        return $this;
    }

    /**
     * @param DocumentDirection::* $direction
     */
    public function setDirection(string $direction): self
    {
        $this->direction = $direction;

        return $this;
    }

    /**
     * @param DocumentType::* $documentType
     */
    public function setDocumentType(string $documentType): self
    {
        $this->documentType = $documentType;

        return $this;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function setInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    public function setInvoiceID(?string $invoiceID): self
    {
        $this->invoiceID = $invoiceID;

        return $this;
    }

    public function setInvoiceTotal(null|float|string $invoiceTotal): self
    {
        $this->invoiceTotal = $invoiceTotal;

        return $this;
    }

    /**
     * @param null|list<Item> $items
     */
    public function setItems(?array $items): self
    {
        $this->items = $items;

        return $this;
    }

    public function setNote(?string $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @param null|list<PaymentDetailCreate> $paymentDetails
     */
    public function setPaymentDetails(?array $paymentDetails): self
    {
        $this->paymentDetails = $paymentDetails;

        return $this;
    }

    public function setPaymentTerm(?string $paymentTerm): self
    {
        $this->paymentTerm = $paymentTerm;

        return $this;
    }

    public function setPreviousUnpaidBalance(
        null|float|string $previousUnpaidBalance
    ): self {
        $this->previousUnpaidBalance = $previousUnpaidBalance;

        return $this;
    }

    public function setPurchaseOrder(?string $purchaseOrder): self
    {
        $this->purchaseOrder = $purchaseOrder;

        return $this;
    }

    public function setRemittanceAddress(?string $remittanceAddress): self
    {
        $this->remittanceAddress = $remittanceAddress;

        return $this;
    }

    public function setRemittanceAddressRecipient(
        ?string $remittanceAddressRecipient
    ): self {
        $this->remittanceAddressRecipient = $remittanceAddressRecipient;

        return $this;
    }

    public function setServiceAddress(?string $serviceAddress): self
    {
        $this->serviceAddress = $serviceAddress;

        return $this;
    }

    public function setServiceAddressRecipient(
        ?string $serviceAddressRecipient
    ): self {
        $this->serviceAddressRecipient = $serviceAddressRecipient;

        return $this;
    }

    public function setServiceEndDate(?\DateTimeInterface $serviceEndDate): self
    {
        $this->serviceEndDate = $serviceEndDate;

        return $this;
    }

    public function setServiceStartDate(
        ?\DateTimeInterface $serviceStartDate
    ): self {
        $this->serviceStartDate = $serviceStartDate;

        return $this;
    }

    public function setShippingAddress(?string $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    public function setShippingAddressRecipient(
        ?string $shippingAddressRecipient
    ): self {
        $this->shippingAddressRecipient = $shippingAddressRecipient;

        return $this;
    }

    /**
     * @param DocumentState::* $state
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function setSubtotal(null|float|string $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * @param null|list<TaxDetail> $taxDetails
     */
    public function setTaxDetails(?array $taxDetails): self
    {
        $this->taxDetails = $taxDetails;

        return $this;
    }

    public function setTotalDiscount(null|float|string $totalDiscount): self
    {
        $this->totalDiscount = $totalDiscount;

        return $this;
    }

    public function setTotalTax(null|float|string $totalTax): self
    {
        $this->totalTax = $totalTax;

        return $this;
    }

    public function setVendorAddress(?string $vendorAddress): self
    {
        $this->vendorAddress = $vendorAddress;

        return $this;
    }

    public function setVendorAddressRecipient(
        ?string $vendorAddressRecipient
    ): self {
        $this->vendorAddressRecipient = $vendorAddressRecipient;

        return $this;
    }

    public function setVendorEmail(?string $vendorEmail): self
    {
        $this->vendorEmail = $vendorEmail;

        return $this;
    }

    public function setVendorName(?string $vendorName): self
    {
        $this->vendorName = $vendorName;

        return $this;
    }

    public function setVendorTaxID(?string $vendorTaxID): self
    {
        $this->vendorTaxID = $vendorTaxID;

        return $this;
    }
}
