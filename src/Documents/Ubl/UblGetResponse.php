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
        $obj = new self;

        $obj['id'] = $id;
        $obj['fileName'] = $fileName;

        null !== $fileHash && $obj['fileHash'] = $fileHash;
        null !== $fileSize && $obj['fileSize'] = $fileSize;
        null !== $receiverPeppolID && $obj['receiverPeppolID'] = $receiverPeppolID;
        null !== $receiverPeppolScheme && $obj['receiverPeppolScheme'] = $receiverPeppolScheme;
        null !== $senderPeppolID && $obj['senderPeppolID'] = $senderPeppolID;
        null !== $senderPeppolScheme && $obj['senderPeppolScheme'] = $senderPeppolScheme;
        null !== $signedURL && $obj['signedURL'] = $signedURL;
        null !== $validatedAt && $obj['validatedAt'] = $validatedAt;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withFileName(string $fileName): self
    {
        $obj = clone $this;
        $obj['fileName'] = $fileName;

        return $obj;
    }

    public function withFileHash(?string $fileHash): self
    {
        $obj = clone $this;
        $obj['fileHash'] = $fileHash;

        return $obj;
    }

    public function withFileSize(int $fileSize): self
    {
        $obj = clone $this;
        $obj['fileSize'] = $fileSize;

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

    public function withSignedURL(?string $signedURL): self
    {
        $obj = clone $this;
        $obj['signedURL'] = $signedURL;

        return $obj;
    }

    public function withValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $obj = clone $this;
        $obj['validatedAt'] = $validatedAt;

        return $obj;
    }
}
