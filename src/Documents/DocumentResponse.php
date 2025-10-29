<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\Documents\DocumentResponse\Allowance;
use EInvoiceAPI\Documents\DocumentResponse\Charge;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Documents\DocumentResponse\TaxCode;
use EInvoiceAPI\Documents\DocumentResponse\TaxDetail;
use EInvoiceAPI\Documents\DocumentResponse\Vatex;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * @phpstan-type document_response = array{
 *   id: string,
 *   allowances?: list<Allowance>|null,
 *   amountDue?: string|null,
 *   attachments?: list<DocumentAttachment>|null,
 *   billingAddress?: string|null,
 *   billingAddressRecipient?: string|null,
 *   charges?: list<Charge>|null,
 *   currency?: value-of<CurrencyCode>,
 *   customerAddress?: string|null,
 *   customerAddressRecipient?: string|null,
 *   customerEmail?: string|null,
 *   customerID?: string|null,
 *   customerName?: string|null,
 *   customerTaxID?: string|null,
 *   direction?: value-of<DocumentDirection>,
 *   documentType?: value-of<DocumentType>,
 *   dueDate?: \DateTimeInterface|null,
 *   invoiceDate?: \DateTimeInterface|null,
 *   invoiceID?: string|null,
 *   invoiceTotal?: string|null,
 *   items?: list<Item>|null,
 *   note?: string|null,
 *   paymentDetails?: list<PaymentDetail>|null,
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
 *   state?: value-of<DocumentState>,
 *   subtotal?: string|null,
 *   taxCode?: value-of<TaxCode>,
 *   taxDetails?: list<TaxDetail>|null,
 *   totalDiscount?: string|null,
 *   totalTax?: string|null,
 *   vatex?: value-of<Vatex>|null,
 *   vatexNote?: string|null,
 *   vendorAddress?: string|null,
 *   vendorAddressRecipient?: string|null,
 *   vendorEmail?: string|null,
 *   vendorName?: string|null,
 *   vendorTaxID?: string|null,
 * }
 */
final class DocumentResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<document_response> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $id;

    /** @var list<Allowance>|null $allowances */
    #[Api(list: Allowance::class, nullable: true, optional: true)]
    public ?array $allowances;

    /**
     * The amount due of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    #[Api('amount_due', nullable: true, optional: true)]
    public ?string $amountDue;

    /** @var list<DocumentAttachment>|null $attachments */
    #[Api(list: DocumentAttachment::class, nullable: true, optional: true)]
    public ?array $attachments;

    #[Api('billing_address', nullable: true, optional: true)]
    public ?string $billingAddress;

    #[Api('billing_address_recipient', nullable: true, optional: true)]
    public ?string $billingAddressRecipient;

    /** @var list<Charge>|null $charges */
    #[Api(list: Charge::class, nullable: true, optional: true)]
    public ?array $charges;

    /**
     * Currency of the invoice.
     *
     * @var value-of<CurrencyCode>|null $currency
     */
    #[Api(enum: CurrencyCode::class, optional: true)]
    public ?string $currency;

    #[Api('customer_address', nullable: true, optional: true)]
    public ?string $customerAddress;

    #[Api('customer_address_recipient', nullable: true, optional: true)]
    public ?string $customerAddressRecipient;

    #[Api('customer_email', nullable: true, optional: true)]
    public ?string $customerEmail;

    #[Api('customer_id', nullable: true, optional: true)]
    public ?string $customerID;

    #[Api('customer_name', nullable: true, optional: true)]
    public ?string $customerName;

    #[Api('customer_tax_id', nullable: true, optional: true)]
    public ?string $customerTaxID;

    /** @var value-of<DocumentDirection>|null $direction */
    #[Api(enum: DocumentDirection::class, optional: true)]
    public ?string $direction;

    /** @var value-of<DocumentType>|null $documentType */
    #[Api('document_type', enum: DocumentType::class, optional: true)]
    public ?string $documentType;

    #[Api('due_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $dueDate;

    #[Api('invoice_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $invoiceDate;

    #[Api('invoice_id', nullable: true, optional: true)]
    public ?string $invoiceID;

    /**
     * The total amount of the invoice (so invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    #[Api('invoice_total', nullable: true, optional: true)]
    public ?string $invoiceTotal;

    /** @var list<Item>|null $items */
    #[Api(list: Item::class, nullable: true, optional: true)]
    public ?array $items;

    #[Api(nullable: true, optional: true)]
    public ?string $note;

    /** @var list<PaymentDetail>|null $paymentDetails */
    #[Api(
        'payment_details',
        list: PaymentDetail::class,
        nullable: true,
        optional: true,
    )]
    public ?array $paymentDetails;

    #[Api('payment_term', nullable: true, optional: true)]
    public ?string $paymentTerm;

    /**
     * The previous unpaid balance of the invoice, if any. Must be positive and rounded to maximum 2 decimals.
     */
    #[Api('previous_unpaid_balance', nullable: true, optional: true)]
    public ?string $previousUnpaidBalance;

    #[Api('purchase_order', nullable: true, optional: true)]
    public ?string $purchaseOrder;

    #[Api('remittance_address', nullable: true, optional: true)]
    public ?string $remittanceAddress;

    #[Api('remittance_address_recipient', nullable: true, optional: true)]
    public ?string $remittanceAddressRecipient;

    #[Api('service_address', nullable: true, optional: true)]
    public ?string $serviceAddress;

    #[Api('service_address_recipient', nullable: true, optional: true)]
    public ?string $serviceAddressRecipient;

    #[Api('service_end_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $serviceEndDate;

    #[Api('service_start_date', nullable: true, optional: true)]
    public ?\DateTimeInterface $serviceStartDate;

    #[Api('shipping_address', nullable: true, optional: true)]
    public ?string $shippingAddress;

    #[Api('shipping_address_recipient', nullable: true, optional: true)]
    public ?string $shippingAddressRecipient;

    /** @var value-of<DocumentState>|null $state */
    #[Api(enum: DocumentState::class, optional: true)]
    public ?string $state;

    /**
     * The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals.
     */
    #[Api(nullable: true, optional: true)]
    public ?string $subtotal;

    /**
     * Tax category code of the invoice.
     *
     * @var value-of<TaxCode>|null $taxCode
     */
    #[Api('tax_code', enum: TaxCode::class, optional: true)]
    public ?string $taxCode;

    /** @var list<TaxDetail>|null $taxDetails */
    #[Api('tax_details', list: TaxDetail::class, nullable: true, optional: true)]
    public ?array $taxDetails;

    /**
     * The total financial discount of the invoice (so discounts not subject to VAT). Must be positive and rounded to maximum 2 decimals.
     */
    #[Api('total_discount', nullable: true, optional: true)]
    public ?string $totalDiscount;

    /**
     * The total tax of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    #[Api('total_tax', nullable: true, optional: true)]
    public ?string $totalTax;

    /**
     * VATEX code list for VAT exemption reasons.
     *
     * Agency: CEF
     * Identifier: vatex
     *
     * @var value-of<Vatex>|null $vatex
     */
    #[Api(enum: Vatex::class, nullable: true, optional: true)]
    public ?string $vatex;

    /**
     * VAT exemption note of the invoice.
     */
    #[Api('vatex_note', nullable: true, optional: true)]
    public ?string $vatexNote;

    #[Api('vendor_address', nullable: true, optional: true)]
    public ?string $vendorAddress;

    #[Api('vendor_address_recipient', nullable: true, optional: true)]
    public ?string $vendorAddressRecipient;

    #[Api('vendor_email', nullable: true, optional: true)]
    public ?string $vendorEmail;

    #[Api('vendor_name', nullable: true, optional: true)]
    public ?string $vendorName;

    #[Api('vendor_tax_id', nullable: true, optional: true)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance>|null $allowances
     * @param list<DocumentAttachment>|null $attachments
     * @param list<Charge>|null $charges
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     * @param DocumentType|value-of<DocumentType> $documentType
     * @param list<Item>|null $items
     * @param list<PaymentDetail>|null $paymentDetails
     * @param DocumentState|value-of<DocumentState> $state
     * @param TaxCode|value-of<TaxCode> $taxCode
     * @param list<TaxDetail>|null $taxDetails
     * @param Vatex|value-of<Vatex>|null $vatex
     */
    public static function with(
        string $id,
        ?array $allowances = null,
        ?string $amountDue = null,
        ?array $attachments = null,
        ?string $billingAddress = null,
        ?string $billingAddressRecipient = null,
        ?array $charges = null,
        CurrencyCode|string|null $currency = null,
        ?string $customerAddress = null,
        ?string $customerAddressRecipient = null,
        ?string $customerEmail = null,
        ?string $customerID = null,
        ?string $customerName = null,
        ?string $customerTaxID = null,
        DocumentDirection|string|null $direction = null,
        DocumentType|string|null $documentType = null,
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
        DocumentState|string|null $state = null,
        ?string $subtotal = null,
        TaxCode|string|null $taxCode = null,
        ?array $taxDetails = null,
        ?string $totalDiscount = null,
        ?string $totalTax = null,
        Vatex|string|null $vatex = null,
        ?string $vatexNote = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
    ): self {
        $obj = new self;

        $obj->id = $id;

        null !== $allowances && $obj->allowances = $allowances;
        null !== $amountDue && $obj->amountDue = $amountDue;
        null !== $attachments && $obj->attachments = $attachments;
        null !== $billingAddress && $obj->billingAddress = $billingAddress;
        null !== $billingAddressRecipient && $obj->billingAddressRecipient = $billingAddressRecipient;
        null !== $charges && $obj->charges = $charges;
        null !== $currency && $obj['currency'] = $currency;
        null !== $customerAddress && $obj->customerAddress = $customerAddress;
        null !== $customerAddressRecipient && $obj->customerAddressRecipient = $customerAddressRecipient;
        null !== $customerEmail && $obj->customerEmail = $customerEmail;
        null !== $customerID && $obj->customerID = $customerID;
        null !== $customerName && $obj->customerName = $customerName;
        null !== $customerTaxID && $obj->customerTaxID = $customerTaxID;
        null !== $direction && $obj['direction'] = $direction;
        null !== $documentType && $obj['documentType'] = $documentType;
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
        null !== $state && $obj['state'] = $state;
        null !== $subtotal && $obj->subtotal = $subtotal;
        null !== $taxCode && $obj['taxCode'] = $taxCode;
        null !== $taxDetails && $obj->taxDetails = $taxDetails;
        null !== $totalDiscount && $obj->totalDiscount = $totalDiscount;
        null !== $totalTax && $obj->totalTax = $totalTax;
        null !== $vatex && $obj['vatex'] = $vatex;
        null !== $vatexNote && $obj->vatexNote = $vatexNote;
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

    /**
     * @param list<Allowance>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $obj = clone $this;
        $obj->allowances = $allowances;

        return $obj;
    }

    /**
     * The amount due of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    public function withAmountDue(?string $amountDue): self
    {
        $obj = clone $this;
        $obj->amountDue = $amountDue;

        return $obj;
    }

    /**
     * @param list<DocumentAttachment>|null $attachments
     */
    public function withAttachments(?array $attachments): self
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
     * @param list<Charge>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $obj = clone $this;
        $obj->charges = $charges;

        return $obj;
    }

    /**
     * Currency of the invoice.
     *
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     */
    public function withCurrency(CurrencyCode|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

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
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     */
    public function withDirection(DocumentDirection|string $direction): self
    {
        $obj = clone $this;
        $obj['direction'] = $direction;

        return $obj;
    }

    /**
     * @param DocumentType|value-of<DocumentType> $documentType
     */
    public function withDocumentType(DocumentType|string $documentType): self
    {
        $obj = clone $this;
        $obj['documentType'] = $documentType;

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

    /**
     * The total amount of the invoice (so invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    public function withInvoiceTotal(?string $invoiceTotal): self
    {
        $obj = clone $this;
        $obj->invoiceTotal = $invoiceTotal;

        return $obj;
    }

    /**
     * @param list<Item>|null $items
     */
    public function withItems(?array $items): self
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
     * @param list<PaymentDetail>|null $paymentDetails
     */
    public function withPaymentDetails(?array $paymentDetails): self
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

    /**
     * The previous unpaid balance of the invoice, if any. Must be positive and rounded to maximum 2 decimals.
     */
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
     * @param DocumentState|value-of<DocumentState> $state
     */
    public function withState(DocumentState|string $state): self
    {
        $obj = clone $this;
        $obj['state'] = $state;

        return $obj;
    }

    /**
     * The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals.
     */
    public function withSubtotal(?string $subtotal): self
    {
        $obj = clone $this;
        $obj->subtotal = $subtotal;

        return $obj;
    }

    /**
     * Tax category code of the invoice.
     *
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public function withTaxCode(TaxCode|string $taxCode): self
    {
        $obj = clone $this;
        $obj['taxCode'] = $taxCode;

        return $obj;
    }

    /**
     * @param list<TaxDetail>|null $taxDetails
     */
    public function withTaxDetails(?array $taxDetails): self
    {
        $obj = clone $this;
        $obj->taxDetails = $taxDetails;

        return $obj;
    }

    /**
     * The total financial discount of the invoice (so discounts not subject to VAT). Must be positive and rounded to maximum 2 decimals.
     */
    public function withTotalDiscount(?string $totalDiscount): self
    {
        $obj = clone $this;
        $obj->totalDiscount = $totalDiscount;

        return $obj;
    }

    /**
     * The total tax of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    public function withTotalTax(?string $totalTax): self
    {
        $obj = clone $this;
        $obj->totalTax = $totalTax;

        return $obj;
    }

    /**
     * VATEX code list for VAT exemption reasons.
     *
     * Agency: CEF
     * Identifier: vatex
     *
     * @param Vatex|value-of<Vatex>|null $vatex
     */
    public function withVatex(Vatex|string|null $vatex): self
    {
        $obj = clone $this;
        $obj['vatex'] = $vatex;

        return $obj;
    }

    /**
     * VAT exemption note of the invoice.
     */
    public function withVatexNote(?string $vatexNote): self
    {
        $obj = clone $this;
        $obj->vatexNote = $vatexNote;

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
