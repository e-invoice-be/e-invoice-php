<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Documents\DocumentResponse\TaxDetail;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * @phpstan-type document_response_alias = array{
 *   id: string,
 *   amountDue?: string|null,
 *   attachments?: list<DocumentAttachment>,
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
 *   invoiceTotal?: string|null,
 *   items?: list<Item>,
 *   note?: string|null,
 *   paymentDetails?: list<PaymentDetail>,
 *   paymentTerm?: string|null,
 *   previousUnpaidBalance?: string|null,
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
 *   subtotal?: string|null,
 *   taxDetails?: list<TaxDetail>,
 *   totalDiscount?: string|null,
 *   totalTax?: string|null,
 *   vendorAddress?: string|null,
 *   vendorAddressRecipient?: string|null,
 *   vendorEmail?: string|null,
 *   vendorName?: string|null,
 *   vendorTaxID?: string|null,
 * }
 */
final class DocumentResponse implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $id;

    #[Api('amount_due', optional: true)]
    public ?string $amountDue;

    /** @var list<DocumentAttachment>|null $attachments */
    #[Api(type: new ListOf(DocumentAttachment::class), optional: true)]
    public ?array $attachments;

    #[Api('billing_address', optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', optional: true)]
    public ?string $billingAddressRecipient;

    /**
     * Currency of the invoice.
     *
     * @var CurrencyCode::*|null $currency
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

    /** @var DocumentDirection::*|null $direction */
    #[Api(enum: DocumentDirection::class, optional: true)]
    public ?string $direction;

    /** @var DocumentType::*|null $documentType */
    #[Api('document_type', enum: DocumentType::class, optional: true)]
    public ?string $documentType;

    #[Api('due_date', optional: true)]
    public ?\DateTimeInterface $dueDate;

    #[Api('invoice_date', optional: true)]
    public ?\DateTimeInterface $invoiceDate;

    #[Api('invoice_id', optional: true)]
    public ?string $invoiceID;

    #[Api('invoice_total', optional: true)]
    public ?string $invoiceTotal;

    /** @var list<Item>|null $items */
    #[Api(type: new ListOf(Item::class), optional: true)]
    public ?array $items;

    #[Api(optional: true)]
    public ?string $note;

    /** @var list<PaymentDetail>|null $paymentDetails */
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

    /** @var DocumentState::*|null $state */
    #[Api(enum: DocumentState::class, optional: true)]
    public ?string $state;

    #[Api(optional: true)]
    public ?string $subtotal;

    /** @var list<TaxDetail>|null $taxDetails */
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
     * `new DocumentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentResponse::with(id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentResponse)->withID(...)
     * ```
     */
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
     * @param list<DocumentAttachment>|null $attachments
     * @param CurrencyCode::* $currency
     * @param DocumentDirection::* $direction
     * @param DocumentType::* $documentType
     * @param list<Item>|null $items
     * @param list<PaymentDetail>|null $paymentDetails
     * @param DocumentState::* $state
     * @param list<TaxDetail>|null $taxDetails
     */
    public static function with(
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
    ): self {
        $obj = new self;

        $obj->id = $id;

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

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withAmountDue(?string $amountDue): self
    {
        $obj = clone $this;
        $obj->amountDue = $amountDue;

        return $obj;
    }

    /**
     * @param list<DocumentAttachment> $attachments
     */
    public function withAttachments(array $attachments): self
    {
        $obj = clone $this;
        $obj->attachments = $attachments;

        return $obj;
    }

    public function withBillingAddress(?string $billingAddress): self
    {
        $obj = clone $this;
        $obj->billingAddress = $billingAddress;

        return $obj;
    }

    public function withBillingAddressRecipient(
        ?string $billingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->billingAddressRecipient = $billingAddressRecipient;

        return $obj;
    }

    /**
     * Currency of the invoice.
     *
     * @param CurrencyCode::* $currency
     */
    public function withCurrency(string $currency): self
    {
        $obj = clone $this;
        $obj->currency = $currency;

        return $obj;
    }

    public function withCustomerAddress(?string $customerAddress): self
    {
        $obj = clone $this;
        $obj->customerAddress = $customerAddress;

        return $obj;
    }

    public function withCustomerAddressRecipient(
        ?string $customerAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->customerAddressRecipient = $customerAddressRecipient;

        return $obj;
    }

    public function withCustomerEmail(?string $customerEmail): self
    {
        $obj = clone $this;
        $obj->customerEmail = $customerEmail;

        return $obj;
    }

    public function withCustomerID(?string $customerID): self
    {
        $obj = clone $this;
        $obj->customerID = $customerID;

        return $obj;
    }

    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj->customerName = $customerName;

        return $obj;
    }

    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $obj = clone $this;
        $obj->customerTaxID = $customerTaxID;

        return $obj;
    }

    /**
     * @param DocumentDirection::* $direction
     */
    public function withDirection(string $direction): self
    {
        $obj = clone $this;
        $obj->direction = $direction;

        return $obj;
    }

    /**
     * @param DocumentType::* $documentType
     */
    public function withDocumentType(string $documentType): self
    {
        $obj = clone $this;
        $obj->documentType = $documentType;

        return $obj;
    }

    public function withDueDate(?\DateTimeInterface $dueDate): self
    {
        $obj = clone $this;
        $obj->dueDate = $dueDate;

        return $obj;
    }

    public function withInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $obj = clone $this;
        $obj->invoiceDate = $invoiceDate;

        return $obj;
    }

    public function withInvoiceID(?string $invoiceID): self
    {
        $obj = clone $this;
        $obj->invoiceID = $invoiceID;

        return $obj;
    }

    public function withInvoiceTotal(?string $invoiceTotal): self
    {
        $obj = clone $this;
        $obj->invoiceTotal = $invoiceTotal;

        return $obj;
    }

    /**
     * @param list<Item> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj->items = $items;

        return $obj;
    }

    public function withNote(?string $note): self
    {
        $obj = clone $this;
        $obj->note = $note;

        return $obj;
    }

    /**
     * @param list<PaymentDetail> $paymentDetails
     */
    public function withPaymentDetails(array $paymentDetails): self
    {
        $obj = clone $this;
        $obj->paymentDetails = $paymentDetails;

        return $obj;
    }

    public function withPaymentTerm(?string $paymentTerm): self
    {
        $obj = clone $this;
        $obj->paymentTerm = $paymentTerm;

        return $obj;
    }

    public function withPreviousUnpaidBalance(
        ?string $previousUnpaidBalance
    ): self {
        $obj = clone $this;
        $obj->previousUnpaidBalance = $previousUnpaidBalance;

        return $obj;
    }

    public function withPurchaseOrder(?string $purchaseOrder): self
    {
        $obj = clone $this;
        $obj->purchaseOrder = $purchaseOrder;

        return $obj;
    }

    public function withRemittanceAddress(?string $remittanceAddress): self
    {
        $obj = clone $this;
        $obj->remittanceAddress = $remittanceAddress;

        return $obj;
    }

    public function withRemittanceAddressRecipient(
        ?string $remittanceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->remittanceAddressRecipient = $remittanceAddressRecipient;

        return $obj;
    }

    public function withServiceAddress(?string $serviceAddress): self
    {
        $obj = clone $this;
        $obj->serviceAddress = $serviceAddress;

        return $obj;
    }

    public function withServiceAddressRecipient(
        ?string $serviceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->serviceAddressRecipient = $serviceAddressRecipient;

        return $obj;
    }

    public function withServiceEndDate(
        ?\DateTimeInterface $serviceEndDate
    ): self {
        $obj = clone $this;
        $obj->serviceEndDate = $serviceEndDate;

        return $obj;
    }

    public function withServiceStartDate(
        ?\DateTimeInterface $serviceStartDate
    ): self {
        $obj = clone $this;
        $obj->serviceStartDate = $serviceStartDate;

        return $obj;
    }

    public function withShippingAddress(?string $shippingAddress): self
    {
        $obj = clone $this;
        $obj->shippingAddress = $shippingAddress;

        return $obj;
    }

    public function withShippingAddressRecipient(
        ?string $shippingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->shippingAddressRecipient = $shippingAddressRecipient;

        return $obj;
    }

    /**
     * @param DocumentState::* $state
     */
    public function withState(string $state): self
    {
        $obj = clone $this;
        $obj->state = $state;

        return $obj;
    }

    public function withSubtotal(?string $subtotal): self
    {
        $obj = clone $this;
        $obj->subtotal = $subtotal;

        return $obj;
    }

    /**
     * @param list<TaxDetail> $taxDetails
     */
    public function withTaxDetails(array $taxDetails): self
    {
        $obj = clone $this;
        $obj->taxDetails = $taxDetails;

        return $obj;
    }

    public function withTotalDiscount(?string $totalDiscount): self
    {
        $obj = clone $this;
        $obj->totalDiscount = $totalDiscount;

        return $obj;
    }

    public function withTotalTax(?string $totalTax): self
    {
        $obj = clone $this;
        $obj->totalTax = $totalTax;

        return $obj;
    }

    public function withVendorAddress(?string $vendorAddress): self
    {
        $obj = clone $this;
        $obj->vendorAddress = $vendorAddress;

        return $obj;
    }

    public function withVendorAddressRecipient(
        ?string $vendorAddressRecipient
    ): self {
        $obj = clone $this;
        $obj->vendorAddressRecipient = $vendorAddressRecipient;

        return $obj;
    }

    public function withVendorEmail(?string $vendorEmail): self
    {
        $obj = clone $this;
        $obj->vendorEmail = $vendorEmail;

        return $obj;
    }

    public function withVendorName(?string $vendorName): self
    {
        $obj = clone $this;
        $obj->vendorName = $vendorName;

        return $obj;
    }

    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $obj = clone $this;
        $obj->vendorTaxID = $vendorTaxID;

        return $obj;
    }
}
