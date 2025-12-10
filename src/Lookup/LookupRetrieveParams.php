<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
 *
 * @see EInvoiceAPI\Services\LookupService::retrieve()
 *
 * @phpstan-type LookupRetrieveParamsShape = array{peppolID: string}
 */
final class LookupRetrieveParams implements BaseModel
{
    /** @use SdkModel<LookupRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    #[Required]
    public string $peppolID;

    /**
     * `new LookupRetrieveParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LookupRetrieveParams::with(peppolID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LookupRetrieveParams)->withPeppolID(...)
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
    public static function with(string $peppolID): self
    {
        $self = new self;

        $self['peppolID'] = $peppolID;

        return $self;
    }

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function withPeppolID(string $peppolID): self
    {
        $self = clone $this;
        $self['peppolID'] = $peppolID;

        return $self;
    }
}
