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
 * @see EInvoiceAPI\DocumentsService::send()
 *
 * @phpstan-type DocumentSendParamsShape = array{
 *   email?: string|null,
 *   receiver_peppol_id?: string|null,
 *   receiver_peppol_scheme?: string|null,
 *   sender_peppol_id?: string|null,
 *   sender_peppol_scheme?: string|null,
 * }
 */
final class DocumentSendParams implements BaseModel
{
    /** @use SdkModel<DocumentSendParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Api(nullable: true, optional: true)]
    public ?string $email;

    #[Api(nullable: true, optional: true)]
    public ?string $receiver_peppol_id;

    #[Api(nullable: true, optional: true)]
    public ?string $receiver_peppol_scheme;

    #[Api(nullable: true, optional: true)]
    public ?string $sender_peppol_id;

    #[Api(nullable: true, optional: true)]
    public ?string $sender_peppol_scheme;

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
        ?string $receiver_peppol_id = null,
        ?string $receiver_peppol_scheme = null,
        ?string $sender_peppol_id = null,
        ?string $sender_peppol_scheme = null,
    ): self {
        $obj = new self;

        null !== $email && $obj->email = $email;
        null !== $receiver_peppol_id && $obj->receiver_peppol_id = $receiver_peppol_id;
        null !== $receiver_peppol_scheme && $obj->receiver_peppol_scheme = $receiver_peppol_scheme;
        null !== $sender_peppol_id && $obj->sender_peppol_id = $sender_peppol_id;
        null !== $sender_peppol_scheme && $obj->sender_peppol_scheme = $sender_peppol_scheme;

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
        $obj->receiver_peppol_id = $receiverPeppolID;

        return $obj;
    }

    public function withReceiverPeppolScheme(
        ?string $receiverPeppolScheme
    ): self {
        $obj = clone $this;
        $obj->receiver_peppol_scheme = $receiverPeppolScheme;

        return $obj;
    }

    public function withSenderPeppolID(?string $senderPeppolID): self
    {
        $obj = clone $this;
        $obj->sender_peppol_id = $senderPeppolID;

        return $obj;
    }

    public function withSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $obj = clone $this;
        $obj->sender_peppol_scheme = $senderPeppolScheme;

        return $obj;
    }
}
