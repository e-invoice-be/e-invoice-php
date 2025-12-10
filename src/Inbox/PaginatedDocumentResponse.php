<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Attachments\DocumentAttachment;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentResponse\Allowance;
use EInvoiceAPI\Documents\DocumentResponse\Charge;
use EInvoiceAPI\Documents\DocumentResponse\Item;
use EInvoiceAPI\Documents\DocumentResponse\PaymentDetail;
use EInvoiceAPI\Documents\DocumentResponse\TaxCode;
use EInvoiceAPI\Documents\DocumentResponse\TaxDetail;
use EInvoiceAPI\Documents\DocumentResponse\Vatex;
use EInvoiceAPI\Documents\DocumentType;

/**
 * @phpstan-type PaginatedDocumentResponseShape = array{
 *   items: list<DocumentResponse>,
 *   page: int,
 *   pageSize: int,
 *   pages: int,
 *   total: int,
 * }
 */
final class PaginatedDocumentResponse implements BaseModel
{
    /** @use SdkModel<PaginatedDocumentResponseShape> */
    use SdkModel;

    /** @var list<DocumentResponse> $items */
    #[Required(list: DocumentResponse::class)]
    public array $items;

    #[Required]
    public int $page;

    #[Required('page_size')]
    public int $pageSize;

    #[Required]
    public int $pages;

    #[Required]
    public int $total;

    /**
     * `new PaginatedDocumentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginatedDocumentResponse::with(
     *   items: ..., page: ..., pageSize: ..., pages: ..., total: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new PaginatedDocumentResponse)
     *   ->withItems(...)
     *   ->withPage(...)
     *   ->withPageSize(...)
     *   ->withPages(...)
     *   ->withTotal(...)
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
     * @param list<DocumentResponse|array{
     *   id: string,
     *   allowances?: list<Allowance>|null,
     *   amountDue?: string|null,
     *   attachments?: list<DocumentAttachment>|null,
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
     * }> $items
     */
    public static function with(
        array $items,
        int $page,
        int $pageSize,
        int $pages,
        int $total
    ): self {
        $self = new self;

        $self['items'] = $items;
        $self['page'] = $page;
        $self['pageSize'] = $pageSize;
        $self['pages'] = $pages;
        $self['total'] = $total;

        return $self;
    }

    /**
     * @param list<DocumentResponse|array{
     *   id: string,
     *   allowances?: list<Allowance>|null,
     *   amountDue?: string|null,
     *   attachments?: list<DocumentAttachment>|null,
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
     * }> $items
     */
    public function withItems(array $items): self
    {
        $self = clone $this;
        $self['items'] = $items;

        return $self;
    }

    public function withPage(int $page): self
    {
        $self = clone $this;
        $self['page'] = $page;

        return $self;
    }

    public function withPageSize(int $pageSize): self
    {
        $self = clone $this;
        $self['pageSize'] = $pageSize;

        return $self;
    }

    public function withPages(int $pages): self
    {
        $self = clone $this;
        $self['pages'] = $pages;

        return $self;
    }

    public function withTotal(int $total): self
    {
        $self = clone $this;
        $self['total'] = $total;

        return $self;
    }
}
