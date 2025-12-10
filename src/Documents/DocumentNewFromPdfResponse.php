<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance\ReasonCode;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse\Item;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse\TaxCode;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse\TaxDetail;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse\Vatex;
use EInvoiceAPI\Inbox\DocumentState;

/**
 * @phpstan-type DocumentNewFromPdfResponseShape = array{
 *   allowances?: list<Allowance>|null,
 *   amountDue?: string|null,
 *   attachments?: list<DocumentAttachmentCreate>|null,
 *   billingAddress?: string|null,
 *   billingAddressRecipient?: string|null,
 *   charges?: list<Charge>|null,
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
 *   paymentDetails?: list<PaymentDetailCreate>|null,
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
 *   success?: bool|null,
 *   taxCode?: value-of<TaxCode>|null,
 *   taxDetails?: list<TaxDetail>|null,
 *   totalDiscount?: string|null,
 *   totalTax?: string|null,
 *   ublDocument?: string|null,
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
final class DocumentNewFromPdfResponse implements BaseModel
{
    /** @use SdkModel<DocumentNewFromPdfResponseShape> */
    use SdkModel;

    /** @var list<Allowance>|null $allowances */
    #[Optional(list: Allowance::class, nullable: true)]
    public ?array $allowances;

    /**
     * The amount due for payment. Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional('amount_due', nullable: true)]
    public ?string $amountDue;

    /** @var list<DocumentAttachmentCreate>|null $attachments */
    #[Optional(list: DocumentAttachmentCreate::class, nullable: true)]
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

    /** @var list<Charge>|null $charges */
    #[Optional(list: Charge::class, nullable: true)]
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

    /**
     * At least one line item is required.
     *
     * @var list<Item>|null $items
     */
    #[Optional(list: Item::class)]
    public ?array $items;

    /**
     * Additional notes or comments for the invoice.
     */
    #[Optional(nullable: true)]
    public ?string $note;

    /** @var list<PaymentDetailCreate>|null $paymentDetails */
    #[Optional(
        'payment_details',
        list: PaymentDetailCreate::class,
        nullable: true
    )]
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
     * Whether the PDF was successfully converted into a compliant e-invoice.
     */
    #[Optional]
    public ?bool $success;

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
     * The UBL document as an XML string.
     */
    #[Optional('ubl_document', nullable: true)]
    public ?string $ublDocument;

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

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<Allowance\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     * @param list<DocumentAttachmentCreate|array{
     *   fileName: string,
     *   fileData?: string|null,
     *   fileSize?: int|null,
     *   fileType?: string|null,
     * }>|null $attachments
     * @param list<Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<Charge\ReasonCode>|null,
     *   taxCode?: value-of<Charge\TaxCode>|null,
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
     * }> $items
     * @param list<PaymentDetailCreate|array{
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
        ?bool $success = null,
        TaxCode|string|null $taxCode = null,
        ?array $taxDetails = null,
        ?string $totalDiscount = null,
        ?string $totalTax = null,
        ?string $ublDocument = null,
        Vatex|string|null $vatex = null,
        ?string $vatexNote = null,
        ?string $vendorAddress = null,
        ?string $vendorAddressRecipient = null,
        ?string $vendorCompanyID = null,
        ?string $vendorEmail = null,
        ?string $vendorName = null,
        ?string $vendorTaxID = null,
    ): self {
        $self = new self;

        null !== $allowances && $self['allowances'] = $allowances;
        null !== $amountDue && $self['amountDue'] = $amountDue;
        null !== $attachments && $self['attachments'] = $attachments;
        null !== $billingAddress && $self['billingAddress'] = $billingAddress;
        null !== $billingAddressRecipient && $self['billingAddressRecipient'] = $billingAddressRecipient;
        null !== $charges && $self['charges'] = $charges;
        null !== $currency && $self['currency'] = $currency;
        null !== $customerAddress && $self['customerAddress'] = $customerAddress;
        null !== $customerAddressRecipient && $self['customerAddressRecipient'] = $customerAddressRecipient;
        null !== $customerCompanyID && $self['customerCompanyID'] = $customerCompanyID;
        null !== $customerEmail && $self['customerEmail'] = $customerEmail;
        null !== $customerID && $self['customerID'] = $customerID;
        null !== $customerName && $self['customerName'] = $customerName;
        null !== $customerTaxID && $self['customerTaxID'] = $customerTaxID;
        null !== $direction && $self['direction'] = $direction;
        null !== $documentType && $self['documentType'] = $documentType;
        null !== $dueDate && $self['dueDate'] = $dueDate;
        null !== $invoiceDate && $self['invoiceDate'] = $invoiceDate;
        null !== $invoiceID && $self['invoiceID'] = $invoiceID;
        null !== $invoiceTotal && $self['invoiceTotal'] = $invoiceTotal;
        null !== $items && $self['items'] = $items;
        null !== $note && $self['note'] = $note;
        null !== $paymentDetails && $self['paymentDetails'] = $paymentDetails;
        null !== $paymentTerm && $self['paymentTerm'] = $paymentTerm;
        null !== $purchaseOrder && $self['purchaseOrder'] = $purchaseOrder;
        null !== $remittanceAddress && $self['remittanceAddress'] = $remittanceAddress;
        null !== $remittanceAddressRecipient && $self['remittanceAddressRecipient'] = $remittanceAddressRecipient;
        null !== $serviceAddress && $self['serviceAddress'] = $serviceAddress;
        null !== $serviceAddressRecipient && $self['serviceAddressRecipient'] = $serviceAddressRecipient;
        null !== $serviceEndDate && $self['serviceEndDate'] = $serviceEndDate;
        null !== $serviceStartDate && $self['serviceStartDate'] = $serviceStartDate;
        null !== $shippingAddress && $self['shippingAddress'] = $shippingAddress;
        null !== $shippingAddressRecipient && $self['shippingAddressRecipient'] = $shippingAddressRecipient;
        null !== $state && $self['state'] = $state;
        null !== $subtotal && $self['subtotal'] = $subtotal;
        null !== $success && $self['success'] = $success;
        null !== $taxCode && $self['taxCode'] = $taxCode;
        null !== $taxDetails && $self['taxDetails'] = $taxDetails;
        null !== $totalDiscount && $self['totalDiscount'] = $totalDiscount;
        null !== $totalTax && $self['totalTax'] = $totalTax;
        null !== $ublDocument && $self['ublDocument'] = $ublDocument;
        null !== $vatex && $self['vatex'] = $vatex;
        null !== $vatexNote && $self['vatexNote'] = $vatexNote;
        null !== $vendorAddress && $self['vendorAddress'] = $vendorAddress;
        null !== $vendorAddressRecipient && $self['vendorAddressRecipient'] = $vendorAddressRecipient;
        null !== $vendorCompanyID && $self['vendorCompanyID'] = $vendorCompanyID;
        null !== $vendorEmail && $self['vendorEmail'] = $vendorEmail;
        null !== $vendorName && $self['vendorName'] = $vendorName;
        null !== $vendorTaxID && $self['vendorTaxID'] = $vendorTaxID;

        return $self;
    }

    /**
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<Allowance\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $self = clone $this;
        $self['allowances'] = $allowances;

        return $self;
    }

    /**
     * The amount due for payment. Must be positive and rounded to maximum 2 decimals.
     */
    public function withAmountDue(?string $amountDue): self
    {
        $self = clone $this;
        $self['amountDue'] = $amountDue;

        return $self;
    }

    /**
     * @param list<DocumentAttachmentCreate|array{
     *   fileName: string,
     *   fileData?: string|null,
     *   fileSize?: int|null,
     *   fileType?: string|null,
     * }>|null $attachments
     */
    public function withAttachments(?array $attachments): self
    {
        $self = clone $this;
        $self['attachments'] = $attachments;

        return $self;
    }

    /**
     * The billing address (if different from customer address).
     */
    public function withBillingAddress(?string $billingAddress): self
    {
        $self = clone $this;
        $self['billingAddress'] = $billingAddress;

        return $self;
    }

    /**
     * The recipient name at the billing address.
     */
    public function withBillingAddressRecipient(
        ?string $billingAddressRecipient
    ): self {
        $self = clone $this;
        $self['billingAddressRecipient'] = $billingAddressRecipient;

        return $self;
    }

    /**
     * @param list<Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<Charge\ReasonCode>|null,
     *   taxCode?: value-of<Charge\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $self = clone $this;
        $self['charges'] = $charges;

        return $self;
    }

    /**
     * Currency of the invoice (ISO 4217 currency code).
     *
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     */
    public function withCurrency(CurrencyCode|string $currency): self
    {
        $self = clone $this;
        $self['currency'] = $currency;

        return $self;
    }

    /**
     * The address of the customer/buyer.
     */
    public function withCustomerAddress(?string $customerAddress): self
    {
        $self = clone $this;
        $self['customerAddress'] = $customerAddress;

        return $self;
    }

    /**
     * The recipient name at the customer address.
     */
    public function withCustomerAddressRecipient(
        ?string $customerAddressRecipient
    ): self {
        $self = clone $this;
        $self['customerAddressRecipient'] = $customerAddressRecipient;

        return $self;
    }

    /**
     * Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withCustomerCompanyID(?string $customerCompanyID): self
    {
        $self = clone $this;
        $self['customerCompanyID'] = $customerCompanyID;

        return $self;
    }

    /**
     * The email address of the customer.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $self = clone $this;
        $self['customerEmail'] = $customerEmail;

        return $self;
    }

    /**
     * The unique identifier for the customer in your system.
     */
    public function withCustomerID(?string $customerID): self
    {
        $self = clone $this;
        $self['customerID'] = $customerID;

        return $self;
    }

    /**
     * The company name of the customer/buyer.
     */
    public function withCustomerName(?string $customerName): self
    {
        $self = clone $this;
        $self['customerName'] = $customerName;

        return $self;
    }

    /**
     * Customer tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $self = clone $this;
        $self['customerTaxID'] = $customerTaxID;

        return $self;
    }

    /**
     * The direction of the document: INBOUND (purchases) or OUTBOUND (sales).
     *
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     */
    public function withDirection(DocumentDirection|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    /**
     * The type of document: INVOICE, CREDIT_NOTE, or DEBIT_NOTE.
     *
     * @param DocumentType|value-of<DocumentType> $documentType
     */
    public function withDocumentType(DocumentType|string $documentType): self
    {
        $self = clone $this;
        $self['documentType'] = $documentType;

        return $self;
    }

    /**
     * The date when payment is due.
     */
    public function withDueDate(?\DateTimeInterface $dueDate): self
    {
        $self = clone $this;
        $self['dueDate'] = $dueDate;

        return $self;
    }

    /**
     * The date when the invoice was issued.
     */
    public function withInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $self = clone $this;
        $self['invoiceDate'] = $invoiceDate;

        return $self;
    }

    /**
     * The unique invoice identifier/number.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $self = clone $this;
        $self['invoiceID'] = $invoiceID;

        return $self;
    }

    /**
     * The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    public function withInvoiceTotal(?string $invoiceTotal): self
    {
        $self = clone $this;
        $self['invoiceTotal'] = $invoiceTotal;

        return $self;
    }

    /**
     * At least one line item is required.
     *
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
     * }> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    /**
     * Additional notes or comments for the invoice.
     */
    public function withNote(?string $note): self
    {
        $self = clone $this;
        $self['note'] = $note;

        return $self;
    }

    /**
     * @param list<PaymentDetailCreate|array{
     *   bankAccountNumber?: string|null,
     *   iban?: string|null,
     *   paymentReference?: string|null,
     *   swift?: string|null,
     * }>|null $paymentDetails
     */
    public function withPaymentDetails(?array $paymentDetails): self
    {
        $self = clone $this;
        $self['paymentDetails'] = $paymentDetails;

        return $self;
    }

    /**
     * The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30').
     */
    public function withPaymentTerm(?string $paymentTerm): self
    {
        $self = clone $this;
        $self['paymentTerm'] = $paymentTerm;

        return $self;
    }

    /**
     * The purchase order reference number.
     */
    public function withPurchaseOrder(?string $purchaseOrder): self
    {
        $self = clone $this;
        $self['purchaseOrder'] = $purchaseOrder;

        return $self;
    }

    /**
     * The address where payment should be sent or remitted to.
     */
    public function withRemittanceAddress(?string $remittanceAddress): self
    {
        $self = clone $this;
        $self['remittanceAddress'] = $remittanceAddress;

        return $self;
    }

    /**
     * The recipient name at the remittance address.
     */
    public function withRemittanceAddressRecipient(
        ?string $remittanceAddressRecipient
    ): self {
        $self = clone $this;
        $self['remittanceAddressRecipient'] = $remittanceAddressRecipient;

        return $self;
    }

    /**
     * The address where services were performed or goods were delivered.
     */
    public function withServiceAddress(?string $serviceAddress): self
    {
        $self = clone $this;
        $self['serviceAddress'] = $serviceAddress;

        return $self;
    }

    /**
     * The recipient name at the service address.
     */
    public function withServiceAddressRecipient(
        ?string $serviceAddressRecipient
    ): self {
        $self = clone $this;
        $self['serviceAddressRecipient'] = $serviceAddressRecipient;

        return $self;
    }

    /**
     * The end date of the service period or delivery period.
     */
    public function withServiceEndDate(
        ?\DateTimeInterface $serviceEndDate
    ): self {
        $self = clone $this;
        $self['serviceEndDate'] = $serviceEndDate;

        return $self;
    }

    /**
     * The start date of the service period or delivery period.
     */
    public function withServiceStartDate(
        ?\DateTimeInterface $serviceStartDate
    ): self {
        $self = clone $this;
        $self['serviceStartDate'] = $serviceStartDate;

        return $self;
    }

    /**
     * The shipping/delivery address.
     */
    public function withShippingAddress(?string $shippingAddress): self
    {
        $self = clone $this;
        $self['shippingAddress'] = $shippingAddress;

        return $self;
    }

    /**
     * The recipient name at the shipping address.
     */
    public function withShippingAddressRecipient(
        ?string $shippingAddressRecipient
    ): self {
        $self = clone $this;
        $self['shippingAddressRecipient'] = $shippingAddressRecipient;

        return $self;
    }

    /**
     * The current state of the document: DRAFT, TRANSIT, FAILED, SENT, or RECEIVED.
     *
     * @param DocumentState|value-of<DocumentState> $state
     */
    public function withState(DocumentState|string $state): self
    {
        $self = clone $this;
        $self['state'] = $state;

        return $self;
    }

    /**
     * The taxable base of the invoice. Should be the sum of all line items - allowances (for example commercial discounts) + charges with impact on VAT. Must be positive and rounded to maximum 2 decimals.
     */
    public function withSubtotal(?string $subtotal): self
    {
        $self = clone $this;
        $self['subtotal'] = $subtotal;

        return $self;
    }

    /**
     * Whether the PDF was successfully converted into a compliant e-invoice.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Tax category code of the invoice (e.g., S for standard rate, Z for zero rate, E for exempt).
     *
     * @param TaxCode|value-of<TaxCode> $taxCode
     */
    public function withTaxCode(TaxCode|string $taxCode): self
    {
        $self = clone $this;
        $self['taxCode'] = $taxCode;

        return $self;
    }

    /**
     * @param list<TaxDetail|array{
     *   amount?: string|null, rate?: string|null
     * }>|null $taxDetails
     */
    public function withTaxDetails(?array $taxDetails): self
    {
        $self = clone $this;
        $self['taxDetails'] = $taxDetails;

        return $self;
    }

    /**
     * The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals.
     */
    public function withTotalDiscount(?string $totalDiscount): self
    {
        $self = clone $this;
        $self['totalDiscount'] = $totalDiscount;

        return $self;
    }

    /**
     * The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    public function withTotalTax(?string $totalTax): self
    {
        $self = clone $this;
        $self['totalTax'] = $totalTax;

        return $self;
    }

    /**
     * The UBL document as an XML string.
     */
    public function withUblDocument(?string $ublDocument): self
    {
        $self = clone $this;
        $self['ublDocument'] = $ublDocument;

        return $self;
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
        $self = clone $this;
        $self['vatex'] = $vatex;

        return $self;
    }

    /**
     * Textual explanation for VAT exemption.
     */
    public function withVatexNote(?string $vatexNote): self
    {
        $self = clone $this;
        $self['vatexNote'] = $vatexNote;

        return $self;
    }

    /**
     * The address of the vendor/seller.
     */
    public function withVendorAddress(?string $vendorAddress): self
    {
        $self = clone $this;
        $self['vendorAddress'] = $vendorAddress;

        return $self;
    }

    /**
     * The recipient name at the vendor address.
     */
    public function withVendorAddressRecipient(
        ?string $vendorAddressRecipient
    ): self {
        $self = clone $this;
        $self['vendorAddressRecipient'] = $vendorAddressRecipient;

        return $self;
    }

    /**
     * Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withVendorCompanyID(?string $vendorCompanyID): self
    {
        $self = clone $this;
        $self['vendorCompanyID'] = $vendorCompanyID;

        return $self;
    }

    /**
     * The email address of the vendor.
     */
    public function withVendorEmail(?string $vendorEmail): self
    {
        $self = clone $this;
        $self['vendorEmail'] = $vendorEmail;

        return $self;
    }

    /**
     * The name of the vendor/seller/supplier.
     */
    public function withVendorName(?string $vendorName): self
    {
        $self = clone $this;
        $self['vendorName'] = $vendorName;

        return $self;
    }

    /**
     * Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $self = clone $this;
        $self['vendorTaxID'] = $vendorTaxID;

        return $self;
    }
}
