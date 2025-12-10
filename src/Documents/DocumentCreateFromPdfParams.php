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
 *   file: string, customerTaxID?: string|null, vendorTaxID?: string|null
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
    public ?string $customerTaxID;

    #[Optional(nullable: true)]
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
        $self = new self;

        $self['file'] = $file;

        null !== $customerTaxID && $self['customerTaxID'] = $customerTaxID;
        null !== $vendorTaxID && $self['vendorTaxID'] = $vendorTaxID;

        return $self;
    }

    public function withFile(string $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }

    public function withCustomerTaxID(?string $customerTaxID): self
    {
        $self = clone $this;
        $self['customerTaxID'] = $customerTaxID;

        return $self;
    }

    public function withVendorTaxID(?string $vendorTaxID): self
    {
        $self = clone $this;
        $self['vendorTaxID'] = $vendorTaxID;

        return $self;
    }
}
