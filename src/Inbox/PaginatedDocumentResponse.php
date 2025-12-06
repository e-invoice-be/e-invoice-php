<?php

declare(strict_types=1);

namespace EInvoiceAPI\Inbox;

use EInvoiceAPI\Core\Attributes\Api;
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
 *   page_size: int,
 *   pages: int,
 *   total: int,
 * }
 */
final class PaginatedDocumentResponse implements BaseModel
{
    /** @use SdkModel<PaginatedDocumentResponseShape> */
    use SdkModel;

    /** @var list<DocumentResponse> $items */
    #[Api(list: DocumentResponse::class)]
    public array $items;

    #[Api]
    public int $page;

    #[Api]
    public int $page_size;

    #[Api]
    public int $pages;

    #[Api]
    public int $total;

    /**
     * `new PaginatedDocumentResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * PaginatedDocumentResponse::with(
     *   items: ..., page: ..., page_size: ..., pages: ..., total: ...
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
     *   amount_due?: string|null,
     *   attachments?: list<DocumentAttachment>|null,
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
     *   payment_details?: list<PaymentDetail>|null,
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
     *   tax_code?: value-of<TaxCode>|null,
     *   tax_details?: list<TaxDetail>|null,
     *   total_discount?: string|null,
     *   total_tax?: string|null,
     *   vatex?: value-of<Vatex>|null,
     *   vatex_note?: string|null,
     *   vendor_address?: string|null,
     *   vendor_address_recipient?: string|null,
     *   vendor_company_id?: string|null,
     *   vendor_email?: string|null,
     *   vendor_name?: string|null,
     *   vendor_tax_id?: string|null,
     * }> $items
     */
    public static function with(
        array $items,
        int $page,
        int $page_size,
        int $pages,
        int $total
    ): self {
        $obj = new self;

        $obj['items'] = $items;
        $obj['page'] = $page;
        $obj['page_size'] = $page_size;
        $obj['pages'] = $pages;
        $obj['total'] = $total;

        return $obj;
    }

    /**
     * @param list<DocumentResponse|array{
     *   id: string,
     *   allowances?: list<Allowance>|null,
     *   amount_due?: string|null,
     *   attachments?: list<DocumentAttachment>|null,
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
     *   payment_details?: list<PaymentDetail>|null,
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
     *   tax_code?: value-of<TaxCode>|null,
     *   tax_details?: list<TaxDetail>|null,
     *   total_discount?: string|null,
     *   total_tax?: string|null,
     *   vatex?: value-of<Vatex>|null,
     *   vatex_note?: string|null,
     *   vendor_address?: string|null,
     *   vendor_address_recipient?: string|null,
     *   vendor_company_id?: string|null,
     *   vendor_email?: string|null,
     *   vendor_name?: string|null,
     *   vendor_tax_id?: string|null,
     * }> $items
     */
    public function withItems(array $items): self
    {
        $obj = clone $this;
        $obj['items'] = $items;

        return $obj;
    }

    public function withPage(int $page): self
    {
        $obj = clone $this;
        $obj['page'] = $page;

        return $obj;
    }

    public function withPageSize(int $pageSize): self
    {
        $obj = clone $this;
        $obj['page_size'] = $pageSize;

        return $obj;
    }

    public function withPages(int $pages): self
    {
        $obj = clone $this;
        $obj['pages'] = $pages;

        return $obj;
    }

    public function withTotal(int $total): self
    {
        $obj = clone $this;
        $obj['total'] = $total;

        return $obj;
    }
}
