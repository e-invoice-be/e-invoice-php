<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class DocumentSendParam implements BaseModel
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
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        ?string $email = null,
        ?string $receiverPeppolID = null,
        ?string $receiverPeppolScheme = null,
        ?string $senderPeppolID = null,
        ?string $senderPeppolScheme = null,
    ) {
        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $email && $this->email = $email;
        null !== $receiverPeppolID && $this->receiverPeppolID = $receiverPeppolID;
        null !== $receiverPeppolScheme && $this
            ->receiverPeppolScheme = $receiverPeppolScheme
        ;
        null !== $senderPeppolID && $this->senderPeppolID = $senderPeppolID;
        null !== $senderPeppolScheme && $this
            ->senderPeppolScheme = $senderPeppolScheme
        ;
    }
}
