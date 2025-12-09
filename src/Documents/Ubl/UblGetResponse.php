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
 *   file_name: string,
 *   file_hash?: string|null,
 *   file_size?: int|null,
 *   receiver_peppol_id?: string|null,
 *   receiver_peppol_scheme?: string|null,
 *   sender_peppol_id?: string|null,
 *   sender_peppol_scheme?: string|null,
 *   signed_url?: string|null,
 *   validated_at?: \DateTimeInterface|null,
 * }
 */
final class UblGetResponse implements BaseModel
{
    /** @use SdkModel<UblGetResponseShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required]
    public string $file_name;

    #[Optional(nullable: true)]
    public ?string $file_hash;

    #[Optional]
    public ?int $file_size;

    #[Optional(nullable: true)]
    public ?string $receiver_peppol_id;

    #[Optional(nullable: true)]
    public ?string $receiver_peppol_scheme;

    #[Optional(nullable: true)]
    public ?string $sender_peppol_id;

    #[Optional(nullable: true)]
    public ?string $sender_peppol_scheme;

    #[Optional(nullable: true)]
    public ?string $signed_url;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $validated_at;

    /**
     * `new UblGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UblGetResponse::with(id: ..., file_name: ...)
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
        string $file_name,
        ?string $file_hash = null,
        ?int $file_size = null,
        ?string $receiver_peppol_id = null,
        ?string $receiver_peppol_scheme = null,
        ?string $sender_peppol_id = null,
        ?string $sender_peppol_scheme = null,
        ?string $signed_url = null,
        ?\DateTimeInterface $validated_at = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['file_name'] = $file_name;

        null !== $file_hash && $obj['file_hash'] = $file_hash;
        null !== $file_size && $obj['file_size'] = $file_size;
        null !== $receiver_peppol_id && $obj['receiver_peppol_id'] = $receiver_peppol_id;
        null !== $receiver_peppol_scheme && $obj['receiver_peppol_scheme'] = $receiver_peppol_scheme;
        null !== $sender_peppol_id && $obj['sender_peppol_id'] = $sender_peppol_id;
        null !== $sender_peppol_scheme && $obj['sender_peppol_scheme'] = $sender_peppol_scheme;
        null !== $signed_url && $obj['signed_url'] = $signed_url;
        null !== $validated_at && $obj['validated_at'] = $validated_at;

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
        $obj['file_name'] = $fileName;

        return $obj;
    }

    public function withFileHash(?string $fileHash): self
    {
        $obj = clone $this;
        $obj['file_hash'] = $fileHash;

        return $obj;
    }

    public function withFileSize(int $fileSize): self
    {
        $obj = clone $this;
        $obj['file_size'] = $fileSize;

        return $obj;
    }

    public function withReceiverPeppolID(?string $receiverPeppolID): self
    {
        $obj = clone $this;
        $obj['receiver_peppol_id'] = $receiverPeppolID;

        return $obj;
    }

    public function withReceiverPeppolScheme(
        ?string $receiverPeppolScheme
    ): self {
        $obj = clone $this;
        $obj['receiver_peppol_scheme'] = $receiverPeppolScheme;

        return $obj;
    }

    public function withSenderPeppolID(?string $senderPeppolID): self
    {
        $obj = clone $this;
        $obj['sender_peppol_id'] = $senderPeppolID;

        return $obj;
    }

    public function withSenderPeppolScheme(?string $senderPeppolScheme): self
    {
        $obj = clone $this;
        $obj['sender_peppol_scheme'] = $senderPeppolScheme;

        return $obj;
    }

    public function withSignedURL(?string $signedURL): self
    {
        $obj = clone $this;
        $obj['signed_url'] = $signedURL;

        return $obj;
    }

    public function withValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $obj = clone $this;
        $obj['validated_at'] = $validatedAt;

        return $obj;
    }
}
