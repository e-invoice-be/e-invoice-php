<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class RetrieveParticipantsParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $query;

    #[Api(optional: true)]
    public ?string $countryCode;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string      $query       `required`
     * @param null|string $countryCode
     */
    final public function __construct($query, $countryCode = None::NOT_GIVEN)
    {
        $this->constructFromArgs(func_get_args());
    }
}

RetrieveParticipantsParams::_loadMetadata();
