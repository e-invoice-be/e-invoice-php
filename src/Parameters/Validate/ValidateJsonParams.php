<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Core\Serde\UnionOf;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\PaymentDetailCreate;

class ValidateJsonParams implements BaseModel
{
    use Model;
    use Params;

    /**
     * @var null|float|string $amountDue
     */
    #[Api('amount_due', optional: true)]
    public mixed $amountDue;

    /**
     * @var null|list<DocumentAttachmentCreate> $attachments
     */
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

    /**
     * @var null|float|string $invoiceTotal
     */
    #[Api('invoice_total', optional: true)]
    public mixed $invoiceTotal;

    /**
     * @var list<array{
     *
     *     amount?: float|string|null,
     *     date?: mixed|null,
     *     description?: string|null,
     *     productCode?: string|null,
     *     quantity?: float|string|null,
     *     tax?: float|string|null,
     *     taxRate?: string|null,
     *     unit?: string,
     *     unitPrice?: float|string|null,
     *
     * }>|null $items
     */
    #[Api(
        type: new UnionOf([new ListOf(new ListOf('mixed')), 'null']),
        optional: true
    )]
    public ?array $items;

    #[Api(optional: true)]
    public ?string $note;

    /**
     * @var null|list<PaymentDetailCreate> $paymentDetails
     */
    #[Api(
        'payment_details',
        type: new UnionOf([new ListOf(PaymentDetailCreate::class), 'null']),
        optional: true,
    )]
    public ?array $paymentDetails;

    #[Api('payment_term', optional: true)]
    public ?string $paymentTerm;

    /**
     * @var null|float|string $previousUnpaidBalance
     */
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

    /**
     * @var null|float|string $subtotal
     */
    #[Api(optional: true)]
    public mixed $subtotal;

    /**
     * @var list<array{
     *
     * amount?: float|string|null, rate?: string|null
     *
     * }>|null $taxDetails
     */
    #[Api(
        'tax_details',
        type: new UnionOf([new ListOf(new ListOf('mixed')), 'null']),
        optional: true,
    )]
    public ?array $taxDetails;

    /**
     * @var null|float|string $totalDiscount
     */
    #[Api('total_discount', optional: true)]
    public mixed $totalDiscount;

    /**
     * @var null|float|string $totalTax
     */
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
}

ValidateJsonParams::_loadMetadata();
