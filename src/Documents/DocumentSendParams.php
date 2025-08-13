<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Send an invoice or credit note via Peppol.
 *
 * @phpstan-type send_params = array{
 *   email?: string|null,
 *   receiverPeppolID?: string|null,
 *   receiverPeppolScheme?: string|null,
 *   senderPeppolID?: string|null,
 *   senderPeppolScheme?: string|null,
 * }
 */
final class DocumentSendParams implements BaseModel
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
    public static function from(
        ?string $email = null,
        ?string $receiverPeppolID = null,
        ?string $receiverPeppolScheme = null,
        ?string $senderPeppolID = null,
        ?string $senderPeppolScheme = null,
    ): self {
        $obj = new self;

        null !== $email && $obj->email = $email;
        null !== $receiverPeppolID && $obj->receiverPeppolID = $receiverPeppolID;
        null !== $receiverPeppolScheme && $obj->receiverPeppolScheme = $receiverPeppolScheme;
        null !== $senderPeppolID && $obj->senderPeppolID = $senderPeppolID;
        null !== $senderPeppolScheme && $obj->senderPeppolScheme = $senderPeppolScheme;

        return $obj;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function setReceiverPeppolID(?string $receiverPeppolID): self
    {
        $this->receiverPeppolID = $receiverPeppolID;

        return $this;
    }

    public function setReceiverPeppolScheme(?string $receiverPeppolScheme): self
    {
        $this->receiverPeppolScheme = $receiverPeppolScheme;

        return $this;
    }

    public function setSenderPeppolID(?string $senderPeppolID): self
    {
        $this->senderPeppolID = $senderPeppolID;

        return $this;
    }

    public function setSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $this->senderPeppolScheme = $senderPeppolScheme;

        return $this;
    }
}
