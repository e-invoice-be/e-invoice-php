<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Send an invoice or credit note via Peppol.
 *
 * @see EInvoiceAPI\Documents->send
 *
 * @phpstan-type document_send_params = array{
 *   email?: string|null,
 *   receiverPeppolID?: string|null,
 *   receiverPeppolScheme?: string|null,
 *   senderPeppolID?: string|null,
 *   senderPeppolScheme?: string|null,
 * }
 */
final class DocumentSendParams implements BaseModel
{
    /** @use SdkModel<document_send_params> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $email;

    #[Api(nullable: true, optional: true)]
    public ?string $receiverPeppolID;

    #[Api(nullable: true, optional: true)]
    public ?string $receiverPeppolScheme;

    #[Api(nullable: true, optional: true)]
    public ?string $senderPeppolID;

    #[Api(nullable: true, optional: true)]
    public ?string $senderPeppolScheme;

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

    public function withEmail(?string $email): self
    {
        $obj = clone $this;
        $obj->email = $email;

        return $obj;
    }

    public function withReceiverPeppolID(?string $receiverPeppolID): self
    {
        $obj = clone $this;
        $obj->receiverPeppolID = $receiverPeppolID;

        return $obj;
    }

    public function withReceiverPeppolScheme(
        ?string $receiverPeppolScheme
    ): self {
        $obj = clone $this;
        $obj->receiverPeppolScheme = $receiverPeppolScheme;

        return $obj;
    }

    public function withSenderPeppolID(?string $senderPeppolID): self
    {
        $obj = clone $this;
        $obj->senderPeppolID = $senderPeppolID;

        return $obj;
    }

    public function withSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $obj = clone $this;
        $obj->senderPeppolScheme = $senderPeppolScheme;

        return $obj;
    }
}
