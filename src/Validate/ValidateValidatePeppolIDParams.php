<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Validate if a Peppol ID exists in the Peppol network and retrieve supported document types. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
 *
 * @see EInvoiceAPI\Services\ValidateService::validatePeppolID()
 *
 * @phpstan-type ValidateValidatePeppolIDParamsShape = array{peppol_id: string}
 */
final class ValidateValidatePeppolIDParams implements BaseModel
{
    /** @use SdkModel<ValidateValidatePeppolIDParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    #[Required]
    public string $peppol_id;

    /**
     * `new ValidateValidatePeppolIDParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ValidateValidatePeppolIDParams::with(peppol_id: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ValidateValidatePeppolIDParams)->withPeppolID(...)
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
    public static function with(string $peppol_id): self
    {
        $obj = new self;

        $obj['peppol_id'] = $peppol_id;

        return $obj;
    }

    /**
     * Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function withPeppolID(string $peppolID): self
    {
        $obj = clone $this;
        $obj['peppol_id'] = $peppolID;

        return $obj;
    }
}
