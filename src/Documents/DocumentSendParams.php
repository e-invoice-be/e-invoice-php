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
        $self = new self;

        null !== $email && $self['email'] = $email;
        null !== $receiverPeppolID && $self['receiverPeppolID'] = $receiverPeppolID;
        null !== $receiverPeppolScheme && $self['receiverPeppolScheme'] = $receiverPeppolScheme;
        null !== $senderPeppolID && $self['senderPeppolID'] = $senderPeppolID;
        null !== $senderPeppolScheme && $self['senderPeppolScheme'] = $senderPeppolScheme;

        return $self;
    }

    public function withEmail(?string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    public function withReceiverPeppolID(?string $receiverPeppolID): self
    {
        $self = clone $this;
        $self['receiverPeppolID'] = $receiverPeppolID;

        return $self;
    }

    public function withReceiverPeppolScheme(
        ?string $receiverPeppolScheme
    ): self {
        $self = clone $this;
        $self['receiverPeppolScheme'] = $receiverPeppolScheme;

        return $self;
    }

    public function withSenderPeppolID(?string $senderPeppolID): self
    {
        $self = clone $this;
        $self['senderPeppolID'] = $senderPeppolID;

        return $self;
    }

    public function withSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $self = clone $this;
        $self['senderPeppolScheme'] = $senderPeppolScheme;

        return $self;
    }
}
