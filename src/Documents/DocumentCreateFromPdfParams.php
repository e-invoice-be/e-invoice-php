<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
 *
 * @see EInvoiceAPI\Services\DocumentsService::createFromPdf()
 *
 * @phpstan-type DocumentCreateFromPdfParamsShape = array{
 *   file: string, customer_tax_id?: string|null, vendor_tax_id?: string|null
 * }
 */
final class DocumentCreateFromPdfParams implements BaseModel
{
    /** @use SdkModel<DocumentCreateFromPdfParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $file;

    #[Optional(nullable: true)]
    public ?string $customer_tax_id;

    #[Optional(nullable: true)]
    public ?string $vendor_tax_id;

    /**
     * `new DocumentCreateFromPdfParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentCreateFromPdfParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentCreateFromPdfParams)->withFile(...)
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
     */
    public static function with(
        string $file,
        ?string $customer_tax_id = null,
        ?string $vendor_tax_id = null
    ): self {
        $obj = new self;

        $obj['file'] = $file;

        null !== $customer_tax_id && $obj['customer_tax_id'] = $customer_tax_id;
        null !== $vendor_tax_id && $obj['vendor_tax_id'] = $vendor_tax_id;

        return $obj;
    }

    public function withFile(string $file): self
    {
        $obj = clone $this;
        $obj['file'] = $file;

        return $obj;
    }

    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $obj = clone $this;
        $obj['customer_tax_id'] = $customerTaxID;

        return $obj;
    }

    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $obj = clone $this;
        $obj['vendor_tax_id'] = $vendorTaxID;

        return $obj;
    }
}
