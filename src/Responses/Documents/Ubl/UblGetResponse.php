<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Documents\Ubl;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type ubl_get_response_alias = array{
 *   id: string,
 *   fileName: string,
 *   fileHash?: string|null,
 *   fileSize?: int,
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
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_hash', optional: true)]
    public ?string $fileHash;

    #[Api('file_size', optional: true)]
    public ?int $fileSize;

    #[Api('receiver_peppol_id', optional: true)]
    public ?string $receiverPeppolID;

    #[Api('receiver_peppol_scheme', optional: true)]
    public ?string $receiverPeppolScheme;

    #[Api('sender_peppol_id', optional: true)]
    public ?string $senderPeppolID;

    #[Api('sender_peppol_scheme', optional: true)]
    public ?string $senderPeppolScheme;

    #[Api('signed_url', optional: true)]
    public ?string $signedURL;

    #[Api('validated_at', optional: true)]
    public ?\DateTimeInterface $validatedAt;

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

        $obj->id = $id;
        $obj->fileName = $fileName;

        null !== $fileHash && $obj->fileHash = $fileHash;
        null !== $fileSize && $obj->fileSize = $fileSize;
        null !== $receiverPeppolID && $obj->receiverPeppolID = $receiverPeppolID;
        null !== $receiverPeppolScheme && $obj->receiverPeppolScheme = $receiverPeppolScheme;
        null !== $senderPeppolID && $obj->senderPeppolID = $senderPeppolID;
        null !== $senderPeppolScheme && $obj->senderPeppolScheme = $senderPeppolScheme;
        null !== $signedURL && $obj->signedURL = $signedURL;
        null !== $validatedAt && $obj->validatedAt = $validatedAt;

        return $obj;
    }

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setFileName(string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function setFileHash(?string $fileHash): self
    {
        $this->fileHash = $fileHash;

        return $this;
    }

    public function setFileSize(int $fileSize): self
    {
        $this->fileSize = $fileSize;

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

    public function setSignedURL(?string $signedURL): self
    {
        $this->signedURL = $signedURL;

        return $this;
    }

    public function setValidatedAt(?\DateTimeInterface $validatedAt): self
    {
        $this->validatedAt = $validatedAt;

        return $this;
    }
}
