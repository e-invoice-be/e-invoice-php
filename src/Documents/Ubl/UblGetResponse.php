<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Ubl;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type UblGetResponseShape = array{
 *   id: string,
 *   fileName: string,
 *   fileHash?: string|null,
 *   fileSize?: int|null,
 *   receiverPeppolID?: string|null,
 *   receiverPeppolScheme?: string|null,
 *   senderPeppolID?: string|null,
 *   senderPeppolScheme?: string|null,
 *   signedURL?: string|null,
 *   validatedAt?: \DateTimeInterface|null,
 * }
 */
final class UblGetResponse implements BaseModel
{
    /** @use SdkModel<UblGetResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('file_name')]
    public string $fileName;

    #[Optional('file_hash', nullable: true)]
    public ?string $fileHash;

    #[Optional('file_size')]
    public ?int $fileSize;

    #[Optional('receiver_peppol_id', nullable: true)]
    public ?string $receiverPeppolID;

    #[Optional('receiver_peppol_scheme', nullable: true)]
    public ?string $receiverPeppolScheme;

    #[Optional('sender_peppol_id', nullable: true)]
    public ?string $senderPeppolID;

    #[Optional('sender_peppol_scheme', nullable: true)]
    public ?string $senderPeppolScheme;

    #[Optional('signed_url', nullable: true)]
    public ?string $signedURL;

    #[Optional('validated_at', nullable: true)]
    public ?\DateTimeInterface $validatedAt;

    /**
     * `new UblGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UblGetResponse::with(id: ..., fileName: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UblGetResponse)->withID(...)->withFileName(...)
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
    public static function with(
        string $id,
        string $fileName,
        ?string $fileHash = null,
        ?int $fileSize = null,
        ?string $receiverPeppolID = null,
        ?string $receiverPeppolScheme = null,
        ?string $senderPeppolID = null,
        ?string $senderPeppolScheme = null,
        ?string $signedURL = null,
        ?\DateTimeInterface $validatedAt = null,
    ): self {
        $self = new self;

        $self['id'] = $id;
        $self['fileName'] = $fileName;

        null !== $fileHash && $self['fileHash'] = $fileHash;
        null !== $fileSize && $self['fileSize'] = $fileSize;
        null !== $receiverPeppolID && $self['receiverPeppolID'] = $receiverPeppolID;
        null !== $receiverPeppolScheme && $self['receiverPeppolScheme'] = $receiverPeppolScheme;
        null !== $senderPeppolID && $self['senderPeppolID'] = $senderPeppolID;
        null !== $senderPeppolScheme && $self['senderPeppolScheme'] = $senderPeppolScheme;
        null !== $signedURL && $self['signedURL'] = $signedURL;
        null !== $validatedAt && $self['validatedAt'] = $validatedAt;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withFileName(string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    public function withFileHash(?string $fileHash): self
    {
        $self = clone $this;
        $self['fileHash'] = $fileHash;

        return $self;
    }

    public function withFileSize(int $fileSize): self
    {
        $self = clone $this;
        $self['fileSize'] = $fileSize;

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

    public function withSignedURL(?string $signedURL): self
    {
        $self = clone $this;
        $self['signedURL'] = $signedURL;

        return $self;
    }

    public function withValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $self = clone $this;
        $self['validatedAt'] = $validatedAt;

        return $self;
    }
}
