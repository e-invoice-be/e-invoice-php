<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Lookup Peppol ID. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
 *
 * @phpstan-type lookup_retrieve_params = array{peppolID: string}
 */
final class LookupRetrieveParams implements BaseModel
{
    /** @use SdkModel<lookup_retrieve_params> */
    use SdkModel;
    use SdkParams;

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    #[Api]
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
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     */
    public static function with(string $peppolID): self
    {
        $obj = new self;

        $obj->peppolID = $peppolID;

        return $obj;
    }

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function withPeppolID(string $peppolID): self
    {
        $obj = clone $this;
        $obj->peppolID = $peppolID;

        return $obj;
    }
}
