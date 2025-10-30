<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
 *
 * @see EInvoiceAPI\Documents->createFromPdf
 *
 * @phpstan-type DocumentCreateFromPdfParamsShape = array{
 *   file: string, customerTaxID?: string|null, vendorTaxID?: string|null
 * }
 */
final class DocumentCreateFromPdfParams implements BaseModel
{
    /** @use SdkModel<DocumentCreateFromPdfParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $file;

    #[Api(nullable: true, optional: true)]
    public ?string $customerTaxID;

    #[Api(nullable: true, optional: true)]
    public ?string $vendorTaxID;

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
        ?string $customerTaxID = null,
        ?string $vendorTaxID = null
    ): self {
        $obj = new self;

        $obj->file = $file;

        null !== $customerTaxID && $obj->customerTaxID = $customerTaxID;
        null !== $vendorTaxID && $obj->vendorTaxID = $vendorTaxID;

        return $obj;
    }

    public function withFile(string $file): self
    {
        $obj = clone $this;
        $obj->file = $file;

        return $obj;
    }

    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $obj = clone $this;
        $obj->customerTaxID = $customerTaxID;

        return $obj;
    }

    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $obj = clone $this;
        $obj->vendorTaxID = $vendorTaxID;

        return $obj;
    }
}
