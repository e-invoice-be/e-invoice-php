<?php

declare(strict_types=1);

namespace EInvoiceAPI\Conversion;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\FileParam;

/**
 * Convert a PDF to a document.
 *
 * @see EInvoiceAPI\Services\ConversionService::createFromPdf()
 *
 * @phpstan-type ConversionCreateFromPdfParamsShape = array{file: string|FileParam}
 */
final class ConversionCreateFromPdfParams implements BaseModel
{
    /** @use SdkModel<ConversionCreateFromPdfParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required(type: FileParam::class)]
    public string|FileParam $file;

    /**
     * `new ConversionCreateFromPdfParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ConversionCreateFromPdfParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ConversionCreateFromPdfParams)->withFile(...)
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
    public static function with(string|FileParam $file): self
    {
        $self = new self;

        $self['file'] = $file;

        return $self;
    }

    public function withFile(string|FileParam $file): self
    {
        $self = clone $this;
        $self['file'] = $file;

        return $self;
    }
}
