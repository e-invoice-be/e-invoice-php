<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class SendParams implements BaseModel
{
    use Model;
    use Params;

    #[Api(optional: true)]
    public ?string $email;

    #[Api(optional: true)]
    public ?string $receiverPeppolID;

    #[Api(optional: true)]
    public ?string $receiverPeppolScheme;

    #[Api(optional: true)]
    public ?string $senderPeppolID;

    #[Api(optional: true)]
    public ?string $senderPeppolScheme;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param null|string $email
     * @param null|string $receiverPeppolID
     * @param null|string $receiverPeppolScheme
     * @param null|string $senderPeppolID
     * @param null|string $senderPeppolScheme
     */
    final public function __construct(
        $email = None::NOT_GIVEN,
        $receiverPeppolID = None::NOT_GIVEN,
        $receiverPeppolScheme = None::NOT_GIVEN,
        $senderPeppolID = None::NOT_GIVEN,
        $senderPeppolScheme = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

SendParams::_loadMetadata();
