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
 *   amount_due?: string|null,
 *   attachments?: list<DocumentAttachmentCreate>|null,
 *   billing_address?: string|null,
 *   billing_address_recipient?: string|null,
 *   charges?: list<Charge>|null,
 *   currency?: value-of<CurrencyCode>|null,
 *   customer_address?: string|null,
 *   customer_address_recipient?: string|null,
 *   customer_company_id?: string|null,
 *   customer_email?: string|null,
 *   customer_id?: string|null,
 *   customer_name?: string|null,
 *   customer_tax_id?: string|null,
 *   direction?: value-of<DocumentDirection>|null,
 *   document_type?: value-of<DocumentType>|null,
 *   due_date?: \DateTimeInterface|null,
 *   invoice_date?: \DateTimeInterface|null,
 *   invoice_id?: string|null,
 *   invoice_total?: string|null,
 *   items?: list<Item>|null,
 *   note?: string|null,
 *   payment_details?: list<PaymentDetailCreate>|null,
 *   payment_term?: string|null,
 *   purchase_order?: string|null,
 *   remittance_address?: string|null,
 *   remittance_address_recipient?: string|null,
 *   service_address?: string|null,
 *   service_address_recipient?: string|null,
 *   service_end_date?: \DateTimeInterface|null,
 *   service_start_date?: \DateTimeInterface|null,
 *   shipping_address?: string|null,
 *   shipping_address_recipient?: string|null,
 *   state?: value-of<DocumentState>|null,
 *   subtotal?: string|null,
 *   success?: bool|null,
 *   tax_code?: value-of<TaxCode>|null,
 *   tax_details?: list<TaxDetail>|null,
 *   total_discount?: string|null,
 *   total_tax?: string|null,
 *   ubl_document?: string|null,
 *   vatex?: value-of<Vatex>|null,
 *   vatex_note?: string|null,
 *   vendor_address?: string|null,
 *   vendor_address_recipient?: string|null,
 *   vendor_company_id?: string|null,
 *   vendor_email?: string|null,
 *   vendor_name?: string|null,
 *   vendor_tax_id?: string|null,
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
    #[Optional(nullable: true)]
    public ?string $amount_due;

    /** @var list<DocumentAttachmentCreate>|null $attachments */
    #[Optional(list: DocumentAttachmentCreate::class, nullable: true)]
    public ?array $attachments;

    /**
     * The billing address (if different from customer address).
     */
    #[Optional(nullable: true)]
    public ?string $billing_address;

    /**
     * The recipient name at the billing address.
     */
    #[Optional(nullable: true)]
    public ?string $billing_address_recipient;

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
    #[Optional(nullable: true)]
    public ?string $customer_address;

    /**
     * The recipient name at the customer address.
     */
    #[Optional(nullable: true)]
    public ?string $customer_address_recipient;

    /**
     * Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    #[Optional(nullable: true)]
    public ?string $customer_company_id;

    /**
     * The email address of the customer.
     */
    #[Optional(nullable: true)]
    public ?string $customer_email;

    /**
     * The unique identifier for the customer in your system.
     */
    #[Optional(nullable: true)]
    public ?string $customer_id;

    /**
     * The company name of the customer/buyer.
     */
    #[Optional(nullable: true)]
    public ?string $customer_name;

    /**
     * Customer tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Optional(nullable: true)]
    public ?string $customer_tax_id;

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
     * @var value-of<DocumentType>|null $document_type
     */
    #[Optional(enum: DocumentType::class)]
    public ?string $document_type;

    /**
     * The date when payment is due.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $due_date;

    /**
     * The date when the invoice was issued.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $invoice_date;

    /**
     * The unique invoice identifier/number.
     */
    #[Optional(nullable: true)]
    public ?string $invoice_id;

    /**
     * The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $invoice_total;

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

    /** @var list<PaymentDetailCreate>|null $payment_details */
    #[Optional(list: PaymentDetailCreate::class, nullable: true)]
    public ?array $payment_details;

    /**
     * The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30').
     */
    #[Optional(nullable: true)]
    public ?string $payment_term;

    /**
     * The purchase order reference number.
     */
    #[Optional(nullable: true)]
    public ?string $purchase_order;

    /**
     * The address where payment should be sent or remitted to.
     */
    #[Optional(nullable: true)]
    public ?string $remittance_address;

    /**
     * The recipient name at the remittance address.
     */
    #[Optional(nullable: true)]
    public ?string $remittance_address_recipient;

    /**
     * The address where services were performed or goods were delivered.
     */
    #[Optional(nullable: true)]
    public ?string $service_address;

    /**
     * The recipient name at the service address.
     */
    #[Optional(nullable: true)]
    public ?string $service_address_recipient;

    /**
     * The end date of the service period or delivery period.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $service_end_date;

    /**
     * The start date of the service period or delivery period.
     */
    #[Optional(nullable: true)]
    public ?\DateTimeInterface $service_start_date;

    /**
     * The shipping/delivery address.
     */
    #[Optional(nullable: true)]
    public ?string $shipping_address;

    /**
     * The recipient name at the shipping address.
     */
    #[Optional(nullable: true)]
    public ?string $shipping_address_recipient;

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
     * @var value-of<TaxCode>|null $tax_code
     */
    #[Optional(enum: TaxCode::class)]
    public ?string $tax_code;

    /** @var list<TaxDetail>|null $tax_details */
    #[Optional(list: TaxDetail::class, nullable: true)]
    public ?array $tax_details;

    /**
     * The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $total_discount;

    /**
     * The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    #[Optional(nullable: true)]
    public ?string $total_tax;

    /**
     * The UBL document as an XML string.
     */
    #[Optional(nullable: true)]
    public ?string $ubl_document;

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
    #[Optional(nullable: true)]
    public ?string $vatex_note;

    /**
     * The address of the vendor/seller.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_address;

    /**
     * The recipient name at the vendor address.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_address_recipient;

    /**
     * Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_company_id;

    /**
     * The email address of the vendor.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_email;

    /**
     * The name of the vendor/seller/supplier.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_name;

    /**
     * Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    #[Optional(nullable: true)]
    public ?string $vendor_tax_id;

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
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<ReasonCode>|null,
     *   tax_code?: value-of<Allowance\TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $allowances
     * @param list<DocumentAttachmentCreate|array{
     *   file_name: string,
     *   file_data?: string|null,
     *   file_size?: int|null,
     *   file_type?: string|null,
     * }>|null $attachments
     * @param list<Charge|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<Charge\ReasonCode>|null,
     *   tax_code?: value-of<Charge\TaxCode>|null,
     *   tax_rate?: string|null,
     * }>|null $charges
     * @param CurrencyCode|value-of<CurrencyCode> $currency
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     * @param DocumentType|value-of<DocumentType> $document_type
     * @param list<Item|array{
     *   allowances?: list<Allowance>|null,
     *   amount?: string|null,
     *   charges?: list<Charge>|null,
     *   date?: null|null,
     *   description?: string|null,
     *   product_code?: string|null,
     *   quantity?: string|null,
     *   tax?: string|null,
     *   tax_rate?: string|null,
     *   unit?: value-of<UnitOfMeasureCode>|null,
     *   unit_price?: string|null,
     * }> $items
     * @param list<PaymentDetailCreate|array{
     *   bank_account_number?: string|null,
     *   iban?: string|null,
     *   payment_reference?: string|null,
     *   swift?: string|null,
     * }>|null $payment_details
     * @param DocumentState|value-of<DocumentState> $state
     * @param TaxCode|value-of<TaxCode> $tax_code
     * @param list<TaxDetail|array{
     *   amount?: string|null, rate?: string|null
     * }>|null $tax_details
     * @param Vatex|value-of<Vatex>|null $vatex
     */
    public static function with(
        ?array $allowances = null,
        ?string $amount_due = null,
        ?array $attachments = null,
        ?string $billing_address = null,
        ?string $billing_address_recipient = null,
        ?array $charges = null,
        CurrencyCode|string|null $currency = null,
        ?string $customer_address = null,
        ?string $customer_address_recipient = null,
        ?string $customer_company_id = null,
        ?string $customer_email = null,
        ?string $customer_id = null,
        ?string $customer_name = null,
        ?string $customer_tax_id = null,
        DocumentDirection|string|null $direction = null,
        DocumentType|string|null $document_type = null,
        ?\DateTimeInterface $due_date = null,
        ?\DateTimeInterface $invoice_date = null,
        ?string $invoice_id = null,
        ?string $invoice_total = null,
        ?array $items = null,
        ?string $note = null,
        ?array $payment_details = null,
        ?string $payment_term = null,
        ?string $purchase_order = null,
        ?string $remittance_address = null,
        ?string $remittance_address_recipient = null,
        ?string $service_address = null,
        ?string $service_address_recipient = null,
        ?\DateTimeInterface $service_end_date = null,
        ?\DateTimeInterface $service_start_date = null,
        ?string $shipping_address = null,
        ?string $shipping_address_recipient = null,
        DocumentState|string|null $state = null,
        ?string $subtotal = null,
        ?bool $success = null,
        TaxCode|string|null $tax_code = null,
        ?array $tax_details = null,
        ?string $total_discount = null,
        ?string $total_tax = null,
        ?string $ubl_document = null,
        Vatex|string|null $vatex = null,
        ?string $vatex_note = null,
        ?string $vendor_address = null,
        ?string $vendor_address_recipient = null,
        ?string $vendor_company_id = null,
        ?string $vendor_email = null,
        ?string $vendor_name = null,
        ?string $vendor_tax_id = null,
    ): self {
        $obj = new self;

        null !== $allowances && $obj['allowances'] = $allowances;
        null !== $amount_due && $obj['amount_due'] = $amount_due;
        null !== $attachments && $obj['attachments'] = $attachments;
        null !== $billing_address && $obj['billing_address'] = $billing_address;
        null !== $billing_address_recipient && $obj['billing_address_recipient'] = $billing_address_recipient;
        null !== $charges && $obj['charges'] = $charges;
        null !== $currency && $obj['currency'] = $currency;
        null !== $customer_address && $obj['customer_address'] = $customer_address;
        null !== $customer_address_recipient && $obj['customer_address_recipient'] = $customer_address_recipient;
        null !== $customer_company_id && $obj['customer_company_id'] = $customer_company_id;
        null !== $customer_email && $obj['customer_email'] = $customer_email;
        null !== $customer_id && $obj['customer_id'] = $customer_id;
        null !== $customer_name && $obj['customer_name'] = $customer_name;
        null !== $customer_tax_id && $obj['customer_tax_id'] = $customer_tax_id;
        null !== $direction && $obj['direction'] = $direction;
        null !== $document_type && $obj['document_type'] = $document_type;
        null !== $due_date && $obj['due_date'] = $due_date;
        null !== $invoice_date && $obj['invoice_date'] = $invoice_date;
        null !== $invoice_id && $obj['invoice_id'] = $invoice_id;
        null !== $invoice_total && $obj['invoice_total'] = $invoice_total;
        null !== $items && $obj['items'] = $items;
        null !== $note && $obj['note'] = $note;
        null !== $payment_details && $obj['payment_details'] = $payment_details;
        null !== $payment_term && $obj['payment_term'] = $payment_term;
        null !== $purchase_order && $obj['purchase_order'] = $purchase_order;
        null !== $remittance_address && $obj['remittance_address'] = $remittance_address;
        null !== $remittance_address_recipient && $obj['remittance_address_recipient'] = $remittance_address_recipient;
        null !== $service_address && $obj['service_address'] = $service_address;
        null !== $service_address_recipient && $obj['service_address_recipient'] = $service_address_recipient;
        null !== $service_end_date && $obj['service_end_date'] = $service_end_date;
        null !== $service_start_date && $obj['service_start_date'] = $service_start_date;
        null !== $shipping_address && $obj['shipping_address'] = $shipping_address;
        null !== $shipping_address_recipient && $obj['shipping_address_recipient'] = $shipping_address_recipient;
        null !== $state && $obj['state'] = $state;
        null !== $subtotal && $obj['subtotal'] = $subtotal;
        null !== $success && $obj['success'] = $success;
        null !== $tax_code && $obj['tax_code'] = $tax_code;
        null !== $tax_details && $obj['tax_details'] = $tax_details;
        null !== $total_discount && $obj['total_discount'] = $total_discount;
        null !== $total_tax && $obj['total_tax'] = $total_tax;
        null !== $ubl_document && $obj['ubl_document'] = $ubl_document;
        null !== $vatex && $obj['vatex'] = $vatex;
        null !== $vatex_note && $obj['vatex_note'] = $vatex_note;
        null !== $vendor_address && $obj['vendor_address'] = $vendor_address;
        null !== $vendor_address_recipient && $obj['vendor_address_recipient'] = $vendor_address_recipient;
        null !== $vendor_company_id && $obj['vendor_company_id'] = $vendor_company_id;
        null !== $vendor_email && $obj['vendor_email'] = $vendor_email;
        null !== $vendor_name && $obj['vendor_name'] = $vendor_name;
        null !== $vendor_tax_id && $obj['vendor_tax_id'] = $vendor_tax_id;

        return $obj;
    }

    /**
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<ReasonCode>|null,
     *   tax_code?: value-of<Allowance\TaxCode>|null,
     *   tax_rate?: string|null,
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
        $obj['amount_due'] = $amountDue;

        return $obj;
    }

    /**
     * @param list<DocumentAttachmentCreate|array{
     *   file_name: string,
     *   file_data?: string|null,
     *   file_size?: int|null,
     *   file_type?: string|null,
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
        $obj['billing_address'] = $billingAddress;

        return $obj;
    }

    /**
     * The recipient name at the billing address.
     */
    public function withBillingAddressRecipient(
        ?string $billingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['billing_address_recipient'] = $billingAddressRecipient;

        return $obj;
    }

    /**
     * @param list<Charge|array{
     *   amount?: string|null,
     *   base_amount?: string|null,
     *   multiplier_factor?: string|null,
     *   reason?: string|null,
     *   reason_code?: value-of<Charge\ReasonCode>|null,
     *   tax_code?: value-of<Charge\TaxCode>|null,
     *   tax_rate?: string|null,
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
        $obj['customer_address'] = $customerAddress;

        return $obj;
    }

    /**
     * The recipient name at the customer address.
     */
    public function withCustomerAddressRecipient(
        ?string $customerAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['customer_address_recipient'] = $customerAddressRecipient;

        return $obj;
    }

    /**
     * Customer company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withCustomerCompanyID(?string $customerCompanyID): self
    {
        $obj = clone $this;
        $obj['customer_company_id'] = $customerCompanyID;

        return $obj;
    }

    /**
     * The email address of the customer.
     */
    public function withCustomerEmail(?string $customerEmail): self
    {
        $obj = clone $this;
        $obj['customer_email'] = $customerEmail;

        return $obj;
    }

    /**
     * The unique identifier for the customer in your system.
     */
    public function withCustomerID(?string $customerID): self
    {
        $obj = clone $this;
        $obj['customer_id'] = $customerID;

        return $obj;
    }

    /**
     * The company name of the customer/buyer.
     */
    public function withCustomerName(?string $customerName): self
    {
        $obj = clone $this;
        $obj['customer_name'] = $customerName;

        return $obj;
    }

    /**
     * Customer tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $obj = clone $this;
        $obj['customer_tax_id'] = $customerTaxID;

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
        $obj['document_type'] = $documentType;

        return $obj;
    }

    /**
     * The date when payment is due.
     */
    public function withDueDate(?\DateTimeInterface $dueDate): self
    {
        $obj = clone $this;
        $obj['due_date'] = $dueDate;

        return $obj;
    }

    /**
     * The date when the invoice was issued.
     */
    public function withInvoiceDate(?\DateTimeInterface $invoiceDate): self
    {
        $obj = clone $this;
        $obj['invoice_date'] = $invoiceDate;

        return $obj;
    }

    /**
     * The unique invoice identifier/number.
     */
    public function withInvoiceID(?string $invoiceID): self
    {
        $obj = clone $this;
        $obj['invoice_id'] = $invoiceID;

        return $obj;
    }

    /**
     * The total amount of the invoice including tax (invoice_total = subtotal + total_tax + total_discount). Must be positive and rounded to maximum 2 decimals.
     */
    public function withInvoiceTotal(?string $invoiceTotal): self
    {
        $obj = clone $this;
        $obj['invoice_total'] = $invoiceTotal;

        return $obj;
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
     *   product_code?: string|null,
     *   quantity?: string|null,
     *   tax?: string|null,
     *   tax_rate?: string|null,
     *   unit?: value-of<UnitOfMeasureCode>|null,
     *   unit_price?: string|null,
     * }> $items
     */
    public function withItems(array $items): self
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
     * @param list<PaymentDetailCreate|array{
     *   bank_account_number?: string|null,
     *   iban?: string|null,
     *   payment_reference?: string|null,
     *   swift?: string|null,
     * }>|null $paymentDetails
     */
    public function withPaymentDetails(?array $paymentDetails): self
    {
        $obj = clone $this;
        $obj['payment_details'] = $paymentDetails;

        return $obj;
    }

    /**
     * The payment terms (e.g., 'Net 30', 'Due on receipt', '2/10 Net 30').
     */
    public function withPaymentTerm(?string $paymentTerm): self
    {
        $obj = clone $this;
        $obj['payment_term'] = $paymentTerm;

        return $obj;
    }

    /**
     * The purchase order reference number.
     */
    public function withPurchaseOrder(?string $purchaseOrder): self
    {
        $obj = clone $this;
        $obj['purchase_order'] = $purchaseOrder;

        return $obj;
    }

    /**
     * The address where payment should be sent or remitted to.
     */
    public function withRemittanceAddress(?string $remittanceAddress): self
    {
        $obj = clone $this;
        $obj['remittance_address'] = $remittanceAddress;

        return $obj;
    }

    /**
     * The recipient name at the remittance address.
     */
    public function withRemittanceAddressRecipient(
        ?string $remittanceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['remittance_address_recipient'] = $remittanceAddressRecipient;

        return $obj;
    }

    /**
     * The address where services were performed or goods were delivered.
     */
    public function withServiceAddress(?string $serviceAddress): self
    {
        $obj = clone $this;
        $obj['service_address'] = $serviceAddress;

        return $obj;
    }

    /**
     * The recipient name at the service address.
     */
    public function withServiceAddressRecipient(
        ?string $serviceAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['service_address_recipient'] = $serviceAddressRecipient;

        return $obj;
    }

    /**
     * The end date of the service period or delivery period.
     */
    public function withServiceEndDate(
        ?\DateTimeInterface $serviceEndDate
    ): self {
        $obj = clone $this;
        $obj['service_end_date'] = $serviceEndDate;

        return $obj;
    }

    /**
     * The start date of the service period or delivery period.
     */
    public function withServiceStartDate(
        ?\DateTimeInterface $serviceStartDate
    ): self {
        $obj = clone $this;
        $obj['service_start_date'] = $serviceStartDate;

        return $obj;
    }

    /**
     * The shipping/delivery address.
     */
    public function withShippingAddress(?string $shippingAddress): self
    {
        $obj = clone $this;
        $obj['shipping_address'] = $shippingAddress;

        return $obj;
    }

    /**
     * The recipient name at the shipping address.
     */
    public function withShippingAddressRecipient(
        ?string $shippingAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['shipping_address_recipient'] = $shippingAddressRecipient;

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
     * Whether the PDF was successfully converted into a compliant e-invoice.
     */
    public function withSuccess(bool $success): self
    {
        $obj = clone $this;
        $obj['success'] = $success;

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
        $obj['tax_code'] = $taxCode;

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
        $obj['tax_details'] = $taxDetails;

        return $obj;
    }

    /**
     * The net financial discount/charge of the invoice (non-VAT charges minus non-VAT allowances). Can be positive (net charge), negative (net discount), or zero. Must be rounded to maximum 2 decimals.
     */
    public function withTotalDiscount(?string $totalDiscount): self
    {
        $obj = clone $this;
        $obj['total_discount'] = $totalDiscount;

        return $obj;
    }

    /**
     * The total tax amount of the invoice. Must be positive and rounded to maximum 2 decimals.
     */
    public function withTotalTax(?string $totalTax): self
    {
        $obj = clone $this;
        $obj['total_tax'] = $totalTax;

        return $obj;
    }

    /**
     * The UBL document as an XML string.
     */
    public function withUblDocument(?string $ublDocument): self
    {
        $obj = clone $this;
        $obj['ubl_document'] = $ublDocument;

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
        $obj['vatex_note'] = $vatexNote;

        return $obj;
    }

    /**
     * The address of the vendor/seller.
     */
    public function withVendorAddress(?string $vendorAddress): self
    {
        $obj = clone $this;
        $obj['vendor_address'] = $vendorAddress;

        return $obj;
    }

    /**
     * The recipient name at the vendor address.
     */
    public function withVendorAddressRecipient(
        ?string $vendorAddressRecipient
    ): self {
        $obj = clone $this;
        $obj['vendor_address_recipient'] = $vendorAddressRecipient;

        return $obj;
    }

    /**
     * Vendor company ID. For Belgium this is the CBE number or their EUID (European Unique Identifier) number. In the Netherlands this is the KVK number.
     */
    public function withVendorCompanyID(?string $vendorCompanyID): self
    {
        $obj = clone $this;
        $obj['vendor_company_id'] = $vendorCompanyID;

        return $obj;
    }

    /**
     * The email address of the vendor.
     */
    public function withVendorEmail(?string $vendorEmail): self
    {
        $obj = clone $this;
        $obj['vendor_email'] = $vendorEmail;

        return $obj;
    }

    /**
     * The name of the vendor/seller/supplier.
     */
    public function withVendorName(?string $vendorName): self
    {
        $obj = clone $this;
        $obj['vendor_name'] = $vendorName;

        return $obj;
    }

    /**
     * Vendor tax ID. For Belgium this is the VAT number. Must include the country prefix.
     */
    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $obj = clone $this;
        $obj['vendor_tax_id'] = $vendorTaxID;

        return $obj;
    }
}
