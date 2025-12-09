<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\Documents\DocumentResponse\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Documents\DocumentResponse\TaxCode;
use EInvoiceAPI\Documents\DocumentResponse\TaxDetail;
use EInvoiceAPI\Documents\DocumentResponse\Vatex;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * @phpstan-type DocumentResponseShape = array{
 *   id: string,
 *   allowances?: list<\EInvoiceAPI\Documents\DocumentResponse\Allowance>|null,
 *   amountDue?: string|null,
 *   attachments?: list<DocumentAttachment>|null,
 *   billingAddress?: string|null,
 *   billingAddressRecipient?: string|null,
 *   charges?: list<\EInvoiceAPI\Documents\DocumentResponse\Charge>|null,
 *   currency?: value-of<CurrencyCode>|null,
 *   customerAddress?: string|null,
 *   customerAddressRecipient?: string|null,
 *   customerCompanyID?: string|null,
 *   customerEmail?: string|null,
 *   customerID?: string|null,
 *   customerName?: string|null,
 *   customerTaxID?: string|null,
 *   direction?: value-of<DocumentDirection>|null,
 *   documentType?: value-of<DocumentType>|null,
 *   dueDate?: \DateTimeInterface|null,
 *   invoiceDate?: \DateTimeInterface|null,
 *   invoiceID?: string|null,
 *   invoiceTotal?: string|null,
 *   items?: list<Item>|null,
 *   note?: string|null,
 *   paymentDetails?: list<PaymentDetail>|null,
 *   paymentTerm?: string|null,
 *   purchaseOrder?: string|null,
 *   remittanceAddress?: string|null,
 *   remittanceAddressRecipient?: string|null,
 *   serviceAddress?: string|null,
 *   serviceAddressRecipient?: string|null,
 *   serviceEndDate?: \DateTimeInterface|null,
 *   serviceStartDate?: \DateTimeInterface|null,
 *   shippingAddress?: string|null,
 *   shippingAddressRecipient?: string|null,
 *   state?: value-of<DocumentState>|null,
 *   subtotal?: string|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxDetails?: list<TaxDetail>|null,
 *   totalDiscount?: string|null,
 *   totalTax?: string|null,
 *   vatex?: value-of<Vatex>|null,
 *   vatexNote?: string|null,
 *   vendorAddress?: string|null,
 *   vendorAddressRecipient?: string|null,
 *   vendorCompanyID?: string|null,
 *   vendorEmail?: string|null,
 *   vendorName?: string|null,
 *   vendorTaxID?: string|null,
 * }
 */
final class DocumentResponse implements BaseModel
{
    /** @use SdkModel<DocumentResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    /** @var list<DocumentResponse\Allowance>|null $allowances */
    #[Optional(
        list: DocumentResponse\Allowance::class,
        nullable: true,
    )]
    public ?array $allowances;

    /**
     * The amount due for payment. Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional('amount_due', nullable: true)]
    public ?string $amountDue;

    /** @var list<DocumentAttachment>|null $attachments */
    #[Optional(list: DocumentAttachment::class, nullable: true)]
    public ?array $attachments;

    /**
     * The billing address (if different from customer address).
     */
    #[Optional('billing_address', nullable: true)]
    public ?string $billingAddress;

    /**
     * The recipient name at the billing address.
     */
    #[Optional('billing_address_recipient', nullable: true)]
    public ?string $billingAddressRecipient;

    /** @var list<DocumentResponse\Charge>|null $charges */
    #[Optional(
        list: DocumentResponse\Charge::class,
        nullable: true
    )]
    public ?array $charges;

    /**
     * Currency of the invoice (ISO 4217 currency code).
     *
     * @var value-of<CurrencyCode>|null $currency
     */
    #[Optional(enum: CurrencyCode::class)]
    public ?string $currency;

    /**
     * The address of the customer/buyer.
     */
    #[Optional('customer_address', nullable: true)]
    public ?string $customerAddress;

    /**
     * The recipient name at the customer address.
     */
    #[Optional('customer_address_recipient', nullable: true)]
    public ?string $customerAddressRecipient;

    /**
     * Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    #[Optional('customer_company_id', nullable: true)]
    public ?string $customerCompanyID;

    /**
     * The email address of the customer.
     */
    #[Optional('customer_email', nullable: true)]
    public ?string $customerEmail;

    /**
     * The unique identifier for the customer in your system.
     */
    #[Optional('customer_id', nullable: true)]
    public ?string $customerID;

    /**
     * The company name of the customer/buyer.
     */
    #[Optional('customer_name', nullable: true)]
    public ?string $customerName;

    /**
     * Customer tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Optional('customer_tax_id', nullable: true)]
    public ?string $customerTaxID;

    /**
     * The direction of the document: INBOUND (purchases) or OUTBOUND (sales).
     *
     * @var value-of<DocumentDirection>|null $direction
     */
    #[Optional(enum: DocumentDirection::class)]
    public ?string $direction;

    /**
     * The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE.
     *
     * @var value-of<DocumentType>|null $documentType
     */
    #[Optional('document_type', enum: DocumentType::class)]
    public ?string $documentType;

    /**
     * The date when payment is due.
     */
    #[Optional('due_date', nullable: true)]
    public ?\DateTimeInterface $dueDate;

    /**
     * The date when the invoice was issued.
     */
    #[Optional('invoice_date', nullable: true)]
    public ?\DateTimeInterface $invoiceDate;

    /**
     * The unique invoice identifier/number.
     */
    #[Optional('invoice_id', nullable: true)]
    public ?string $invoiceID;

    /**
     * The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional('invoice_total', nullable: true)]
    public ?string $invoiceTotal;

    /** @var list<Item>|null $items */
    #[Optional(list: Item::class, nullable: true)]
    public ?array $items;

    /**
     * Additional notes or comments for the invoice.
     */
    #[Optional(nullable: true)]
    public ?string $note;

    /** @var list<PaymentDetail>|null $paymentDetails */
    #[Optional('payment_details', list: PaymentDetail::class, nullable: true)]
    public ?array $paymentDetails;

    /**
     * The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30').
     */
    #[Optional('payment_term', nullable: true)]
    public ?string $paymentTerm;

    /**
     * The purchase order reference number.
     */
    #[Optional('purchase_order', nullable: true)]
    public ?string $purchaseOrder;

    /**
     * The address where payment should be sent or remitted to.
     */
    #[Optional('remittance_address', nullable: true)]
    public ?string $remittanceAddress;

    /**
     * The recipient name at the remittance address.
     */
    #[Optional('remittance_address_recipient', nullable: true)]
    public ?string $remittanceAddressRecipient;

    /**
     * The address where services were performed or goods were delivered.
     */
    #[Optional('service_address', nullable: true)]
    public ?string $serviceAddress;

    /**
     * The recipient name at the service address.
     */
    #[Optional('service_address_recipient', nullable: true)]
    public ?string $serviceAddressRecipient;

    /**
     * The end date of the service period or delivery period.
     */
    #[Optional('service_end_date', nullable: true)]
    public ?\DateTimeInterface $serviceEndDate;

    /**
     * The start date of the service period or delivery period.
     */
    #[Optional('service_start_date', nullable: true)]
    public ?\DateTimeInterface $serviceStartDate;

    /**
     * The shipping/delivery address.
     */
    #[Optional('shipping_address', nullable: true)]
    public ?string $shippingAddress;

    /**
     * The recipient name at the shipping address.
     */
    #[Optional('shipping_address_recipient', nullable: true)]
    public ?string $shippingAddressRecipient;

    /**
     * The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED.
     *
     * @var value-of<DocumentState>|null $state
     */
    #[Optional(enum: DocumentState::class)]
    public ?string $state;

    /**
     * The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $subtotal;

    /**
     * Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt).
     *
     * @var value-of<TaxCode>|null $taxCode
     */
    #[Optional('tax_code', enum: TaxCode::class)]
    public ?string $taxCode;

    /** @var list<TaxDetail>|null $taxDetails */
    #[Optional('tax_details', list: TaxDetail::class, nullable: true)]
    public ?array $taxDetails;

    /**
     * The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals.
     */
    #[Optional('total_discount', nullable: true)]
    public ?string $totalDiscount;

    /**
     * The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional('total_tax', nullable: true)]
    public ?string $totalTax;

    /**
     * VATEX code list for VAT exemption reasons.
     *
     * Agency: CEF
     * Identifier: vatex
     *
     * @var value-of<Vatex>|null $vatex
     */
    #[Optional(enum: Vatex::class, nullable: true)]
    public ?string $vatex;

    /**
     * Textual explanation for VAT exemption.
     */
    #[Optional('vatex_note', nullable: true)]
    public ?string $vatexNote;

    /**
     * The address of the vendor/seller.
     */
    #[Optional('vendor_address', nullable: true)]
    public ?string $vendorAddress;

    /**
     * The recipient name at the vendor address.
     */
    #[Optional('vendor_address_recipient', nullable: true)]
    public ?string $vendorAddressRecipient;

    /**
     * Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    #[Optional('vendor_company_id', nullable: true)]
    public ?string $vendorCompanyID;

    /**
     * The email address of the vendor.
     */
    #[Optional('vendor_email', nullable: true)]
    public ?string $vendorEmail;

    /**
     * The name of the vendor/seller/supplier.
     */
    #[Optional('vendor_name', nullable: true)]
    public ?string $vendorName;

    /**
     * Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Optional('vendor_tax_id', nullable: true)]
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
     * @param list<DocumentResponse\Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<DocumentResponse\Allowance\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     * @param list<DocumentAttachment|array{
     *   id: string,
     *   fileName: string,
     *   fileSize?: int|null,
     *   fileType?: string|null,
     *   fileURL?: string|null,
     * }>|null $attachments
     * @param list<DocumentResponse\Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<DocumentResponse\Charge\ReasonCode>|null,
     *   taxCode?: value-of<DocumentResponse\Charge\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $charges
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     * @param DocumentType|value-of<DocumentType> $documentType
     * @param list<Item|array{
     *   allowances?: list<Allowance>|null,
     *   amount?: string|null,
     *   charges?: list<Charge>|null,
     *   date?: null|null,
     *   description?: string|null,
     *   productCode?: string|null,
     *   quantity?: string|null,
     *   tax?: string|null,
     *   taxRate?: string|null,
     *   unit?: value-of<UnitOfMeasureCode>|null,
     *   unitPrice?: string|null,
     * }>|null $items
     * @param list<PaymentDetail|array{
     *   bankAccountNumber?: string|null,
     *   iban?: string|null,
     *   paymentReference?: string|null,
     *   swift?: string|null,
     * }>|null $paymentDetails
     * @param DocumentState|value-of<DocumentState> $state
     * @param TaxCode|value-of<TaxCode> $taxCode
     * @param list<TaxDetail|array{
     *   amount?: string|null, rate?: string|null
     * }>|null $taxDetails
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
        ?string $customerCompanyID = null,
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
        ?string $vendorCompanyID = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;

        null !== $allowances && $obj['allowances'] = $allowances;
        null !== $amountDue && $obj['amountDue'] = $amountDue;
        null !== $attachments && $obj['attachments'] = $attachments;
        null !== $billingAddress && $obj['billingAddress'] = $billingAddress;
        null !== $billingAddressRecipient && $obj['billingAddressRecipient'] = $billingAddressRecipient;
        null !== $charges && $obj['charges'] = $charges;
        null !== $currency && $obj['currency'] = $currency;
        null !== $customerAddress && $obj['customerAddress'] = $customerAddress;
        null !== $customerAddressRecipient && $obj['customerAddressRecipient'] = $customerAddressRecipient;
        null !== $customerCompanyID && $obj['customerCompanyID'] = $customerCompanyID;
        null !== $customerEmail && $obj['customerEmail'] = $customerEmail;
        null !== $customerID && $obj['customerID'] = $customerID;
        null !== $customerName && $obj['customerName'] = $customerName;
        null !== $customerTaxID && $obj['customerTaxID'] = $customerTaxID;
        null !== $direction && $obj['direction'] = $direction;
        null !== $documentType && $obj['documentType'] = $documentType;
        null !== $dueDate && $obj['dueDate'] = $dueDate;
        null !== $invoiceDate && $obj['invoiceDate'] = $invoiceDate;
        null !== $invoiceID && $obj['invoiceID'] = $invoiceID;
        null !== $invoiceTotal && $obj['invoiceTotal'] = $invoiceTotal;
        null !== $items && $obj['items'] = $items;
        null !== $note && $obj['note'] = $note;
        null !== $paymentDetails && $obj['paymentDetails'] = $paymentDetails;
        null !== $paymentTerm && $obj['paymentTerm'] = $paymentTerm;
        null !== $purchaseOrder && $obj['purchaseOrder'] = $purchaseOrder;
        null !== $remittanceAddress && $obj['remittanceAddress'] = $remittanceAddress;
        null !== $remittanceAddressRecipient && $obj['remittanceAddressRecipient'] = $remittanceAddressRecipient;
        null !== $serviceAddress && $obj['serviceAddress'] = $serviceAddress;
        null !== $serviceAddressRecipient && $obj['serviceAddressRecipient'] = $serviceAddressRecipient;
        null !== $serviceEndDate && $obj['serviceEndDate'] = $serviceEndDate;
        null !== $serviceStartDate && $obj['serviceStartDate'] = $serviceStartDate;
        null !== $shippingAddress && $obj['shippingAddress'] = $shippingAddress;
        null !== $shippingAddressRecipient && $obj['shippingAddressRecipient'] = $shippingAddressRecipient;
        null !== $state && $obj['state'] = $state;
        null !== $subtotal && $obj['subtotal'] = $subtotal;
        null !== $taxCode && $obj['taxCode'] = $taxCode;
        null !== $taxDetails && $obj['taxDetails'] = $taxDetails;
        null !== $totalDiscount && $obj['totalDiscount'] = $totalDiscount;
        null !== $totalTax && $obj['totalTax'] = $totalTax;
        null !== $vatex && $obj['vatex'] = $vatex;
        null !== $vatexNote && $obj['vatexNote'] = $vatexNote;
        null !== $vendorAddress && $obj['vendorAddress'] = $vendorAddress;
        null !== $vendorAddressRecipient && $obj['vendorAddressRecipient'] = $vendorAddressRecipient;
        null !== $vendorCompanyID && $obj['vendorCompanyID'] = $vendorCompanyID;
        null !== $vendorEmail && $obj['vendorEmail'] = $vendorEmail;
        null !== $vendorName && $obj['vendorName'] = $vendorName;
        null !== $vendorTaxID && $obj['vendorTaxID'] = $vendorTaxID;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    /**
     * @param list<DocumentResponse\Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<DocumentResponse\Allowance\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $obj = clone $this;
        $obj['allowances'] = $allowances;

        return $obj;
    }

    /**
     * The amount due for payment. Must be positive and rounded to maximum 2 decimals.
     */
    public function withAmountDue(?string $amountDue): self
    {
        $obj = clone $this;
        $obj['amountDue'] = $amountDue;

        return $obj;
    }

    /**
     * @param list<DocumentAttachment|array{
     *   id: string,
     *   fileName: string,
     *   fileSize?: int|null,
     *   fileType?: string|null,
     *   fileURL?: string|null,
     * }>|null $attachments
     */
    public function withAttachments(?array $attachments): self
    {
        $obj = clone $this;
        $obj['attachments'] = $attachments;

        return $obj;
    }

    /**
     * The billing address (if different from customer address).
     */
    public function withBillingAddress(?string $billingAddress): self
    {
        $obj = clone $this;
        $obj['billingAddress'] = $billingAddress;

        return $obj;
    }

    /**
     * The recipient name at the billing address.
     */
    public function withBillingAddressRecipient(
        ?string $billingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['billingAddressRecipient'] = $billingAddressRecipient;

        return $obj;
    }

    /**
     * @param list<DocumentResponse\Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<DocumentResponse\Charge\ReasonCode>|null,
     *   taxCode?: value-of<DocumentResponse\Charge\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $obj = clone $this;
        $obj['charges'] = $charges;

        return $obj;
    }

    /**
     * Currency of the invoice (ISO 4217 currency code).
     *
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     */
    public function withCurrency(CurrencyCode|string $currency): self
    {
        $obj = clone $this;
        $obj['currency'] = $currency;

        return $obj;
    }

    /**
     * The address of the customer/buyer.
     */
    public function withCustomerAddress(?string $customerAddress): self
    {
        $obj = clone $this;
        $obj['customerAddress'] = $customerAddress;

        return $obj;
    }

    /**
     * The recipient name at the customer address.
     */
    public function withCustomerAddressRecipient(
        ?string $customerAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['customerAddressRecipient'] = $customerAddressRecipient;

        return $obj;
    }

    /**
     * Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withCustomerCompanyID(?string $customerCompanyID): self
    {
        $obj = clone $this;
        $obj['customerCompanyID'] = $customerCompanyID;

        return $obj;
    }

    /**
     * The email address of the customer.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $obj = clone $this;
        $obj['customerEmail'] = $customerEmail;

        return $obj;
    }

    /**
     * The unique identifier for the customer in your system.
     */
    public function withCustomerID(?string $customerID): self
    {
        $obj = clone $this;
        $obj['customerID'] = $customerID;

        return $obj;
    }

    /**
     * The company name of the customer/buyer.
     */
    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj['customerName'] = $customerName;

        return $obj;
    }

    /**
     * Customer tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $obj = clone $this;
        $obj['customerTaxID'] = $customerTaxID;

        return $obj;
    }

    /**
     * The direction of the document: INBOUND (purchases) or OUTBOUND (sales).
     *
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     */
    public function withDirection(DocumentDirection|string $direction): self
    {
        $obj = clone $this;
        $obj['direction'] = $direction;

        return $obj;
    }

    /**
     * The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE.
     *
     * @param DocumentType|value-of<DocumentType> $documentType
     */
    public function withDocumentType(DocumentType|string $documentType): self
    {
        $obj = clone $this;
        $obj['documentType'] = $documentType;

        return $obj;
    }

    /**
     * The date when payment is due.
     */
    public function withDueDate(?\DateTimeInterface $dueDate): self
    {
        $obj = clone $this;
        $obj['dueDate'] = $dueDate;

        return $obj;
    }

    /**
     * The date when the invoice was issued.
     */
    public function withInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $obj = clone $this;
        $obj['invoiceDate'] = $invoiceDate;

        return $obj;
    }

    /**
     * The unique invoice identifier/number.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $obj = clone $this;
        $obj['invoiceID'] = $invoiceID;

        return $obj;
    }

    /**
     * The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    public function withInvoiceTotal(?string $invoiceTotal): self
    {
        $obj = clone $this;
        $obj['invoiceTotal'] = $invoiceTotal;

        return $obj;
    }

    /**
     * @param list<Item|array{
     *   allowances?: list<Allowance>|null,
     *   amount?: string|null,
     *   charges?: list<Charge>|null,
     *   date?: null|null,
     *   description?: string|null,
     *   productCode?: string|null,
     *   quantity?: string|null,
     *   tax?: string|null,
     *   taxRate?: string|null,
     *   unit?: value-of<UnitOfMeasureCode>|null,
     *   unitPrice?: string|null,
     * }>|null $items
     */
    public function withItems(?array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }

    /**
     * Additional notes or comments for the invoice.
     */
    public function withNote(?string $note): self
    {
        $obj = clone $this;
        $obj['note'] = $note;

        return $obj;
    }

    /**
     * @param list<PaymentDetail|array{
     *   bankAccountNumber?: string|null,
     *   iban?: string|null,
     *   paymentReference?: string|null,
     *   swift?: string|null,
     * }>|null $paymentDetails
     */
    public function withPaymentDetails(?array $paymentDetails): self
    {
        $obj = clone $this;
        $obj['paymentDetails'] = $paymentDetails;

        return $obj;
    }

    /**
     * The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30').
     */
    public function withPaymentTerm(?string $paymentTerm): self
    {
        $obj = clone $this;
        $obj['paymentTerm'] = $paymentTerm;

        return $obj;
    }

    /**
     * The purchase order reference number.
     */
    public function withPurchaseOrder(?string $purchaseOrder): self
    {
        $obj = clone $this;
        $obj['purchaseOrder'] = $purchaseOrder;

        return $obj;
    }

    /**
     * The address where payment should be sent or remitted to.
     */
    public function withRemittanceAddress(?string $remittanceAddress): self
    {
        $obj = clone $this;
        $obj['remittanceAddress'] = $remittanceAddress;

        return $obj;
    }

    /**
     * The recipient name at the remittance address.
     */
    public function withRemittanceAddressRecipient(
        ?string $remittanceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['remittanceAddressRecipient'] = $remittanceAddressRecipient;

        return $obj;
    }

    /**
     * The address where services were performed or goods were delivered.
     */
    public function withServiceAddress(?string $serviceAddress): self
    {
        $obj = clone $this;
        $obj['serviceAddress'] = $serviceAddress;

        return $obj;
    }

    /**
     * The recipient name at the service address.
     */
    public function withServiceAddressRecipient(
        ?string $serviceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['serviceAddressRecipient'] = $serviceAddressRecipient;

        return $obj;
    }

    /**
     * The end date of the service period or delivery period.
     */
    public function withServiceEndDate(
        ?\DateTimeInterface $serviceEndDate
    ): self {
        $obj = clone $this;
        $obj['serviceEndDate'] = $serviceEndDate;

        return $obj;
    }

    /**
     * The start date of the service period or delivery period.
     */
    public function withServiceStartDate(
        ?\DateTimeInterface $serviceStartDate
    ): self {
        $obj = clone $this;
        $obj['serviceStartDate'] = $serviceStartDate;

        return $obj;
    }

    /**
     * The shipping/delivery address.
     */
    public function withShippingAddress(?string $shippingAddress): self
    {
        $obj = clone $this;
        $obj['shippingAddress'] = $shippingAddress;

        return $obj;
    }

    /**
     * The recipient name at the shipping address.
     */
    public function withShippingAddressRecipient(
        ?string $shippingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['shippingAddressRecipient'] = $shippingAddressRecipient;

        return $obj;
    }

    /**
     * The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED.
     *
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
        $obj['subtotal'] = $subtotal;

        return $obj;
    }

    /**
     * Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt).
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
     * @param list<TaxDetail|array{
     *   amount?: string|null, rate?: string|null
     * }>|null $taxDetails
     */
    public function withTaxDetails(?array $taxDetails): self
    {
        $obj = clone $this;
        $obj['taxDetails'] = $taxDetails;

        return $obj;
    }

    /**
     * The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals.
     */
    public function withTotalDiscount(?string $totalDiscount): self
    {
        $obj = clone $this;
        $obj['totalDiscount'] = $totalDiscount;

        return $obj;
    }

    /**
     * The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    public function withTotalTax(?string $totalTax): self
    {
        $obj = clone $this;
        $obj['totalTax'] = $totalTax;

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
     * Textual explanation for VAT exemption.
     */
    public function withVatexNote(?string $vatexNote): self
    {
        $obj = clone $this;
        $obj['vatexNote'] = $vatexNote;

        return $obj;
    }

    /**
     * The address of the vendor/seller.
     */
    public function withVendorAddress(?string $vendorAddress): self
    {
        $obj = clone $this;
        $obj['vendorAddress'] = $vendorAddress;

        return $obj;
    }

    /**
     * The recipient name at the vendor address.
     */
    public function withVendorAddressRecipient(
        ?string $vendorAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['vendorAddressRecipient'] = $vendorAddressRecipient;

        return $obj;
    }

    /**
     * Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withVendorCompanyID(?string $vendorCompanyID): self
    {
        $obj = clone $this;
        $obj['vendorCompanyID'] = $vendorCompanyID;

        return $obj;
    }

    /**
     * The email address of the vendor.
     */
    public function withVendorEmail(?string $vendorEmail): self
    {
        $obj = clone $this;
        $obj['vendorEmail'] = $vendorEmail;

        return $obj;
    }

    /**
     * The name of the vendor/seller/supplier.
     */
    public function withVendorName(?string $vendorName): self
    {
        $obj = clone $this;
        $obj['vendorName'] = $vendorName;

        return $obj;
    }

    /**
     * Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $obj = clone $this;
        $obj['vendorTaxID'] = $vendorTaxID;

        return $obj;
    }
}
