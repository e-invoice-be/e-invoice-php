<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Send an invoice or credit note via Peppol.
 *
 * @see EInvoiceAPI\Services\DocumentsService::send()
 *
 * @phpstan-type DocumentSendParamsShape = array{
 *   email?: string|null,
 *   receiverPeppolID?: string|null,
 *   receiverPeppolScheme?: string|null,
 *   senderPeppolID?: string|null,
 *   senderPeppolScheme?: string|null,
 * }
 */
final class DocumentSendParams implements BaseModel
{
    /** @use SdkModel<DocumentSendParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Optional(nullable: true)]
    public ?string $email;

    #[Optional(nullable: true)]
    public ?string $receiverPeppolID;

    #[Optional(nullable: true)]
    public ?string $receiverPeppolScheme;

    #[Optional(nullable: true)]
    public ?string $senderPeppolID;

    #[Optional(nullable: true)]
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

        null !== $email && $obj['email'] = $email;
        null !== $receiverPeppolID && $obj['receiverPeppolID'] = $receiverPeppolID;
        null !== $receiverPeppolScheme && $obj['receiverPeppolScheme'] = $receiverPeppolScheme;
        null !== $senderPeppolID && $obj['senderPeppolID'] = $senderPeppolID;
        null !== $senderPeppolScheme && $obj['senderPeppolScheme'] = $senderPeppolScheme;

        return $obj;
    }

    public function withEmail(?string $email): self
    {
        $obj = clone $this;
        $obj['email'] = $email;

        return $obj;
    }

    public function withReceiverPeppolID(?string $receiverPeppolID): self
    {
        $obj = clone $this;
        $obj['receiverPeppolID'] = $receiverPeppolID;

        return $obj;
    }

    public function withReceiverPeppolScheme(
        ?string $receiverPeppolScheme
    ): self {
        $obj = clone $this;
        $obj['receiverPeppolScheme'] = $receiverPeppolScheme;

        return $obj;
    }

    public function withSenderPeppolID(?string $senderPeppolID): self
    {
        $obj = clone $this;
        $obj['senderPeppolID'] = $senderPeppolID;

        return $obj;
    }

    public function withSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $obj = clone $this;
        $obj['senderPeppolScheme'] = $senderPeppolScheme;

        return $obj;
    }
}
