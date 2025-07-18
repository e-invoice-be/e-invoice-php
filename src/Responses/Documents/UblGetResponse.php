<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

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
    public ?int $fileSize = 0;

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

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(
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
    ) {
        $this->id = $id;
        $this->fileName = $fileName;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $fileHash && $this->fileHash = $fileHash;
        null !== $fileSize && $this->fileSize = $fileSize;
        null !== $receiverPeppolID && $this->receiverPeppolID = $receiverPeppolID;
        null !== $receiverPeppolScheme && $this
            ->receiverPeppolScheme = $receiverPeppolScheme
        ;
        null !== $senderPeppolID && $this->senderPeppolID = $senderPeppolID;
        null !== $senderPeppolScheme && $this
            ->senderPeppolScheme = $senderPeppolScheme
        ;
        null !== $signedURL && $this->signedURL = $signedURL;
        null !== $validatedAt && $this->validatedAt = $validatedAt;
    }
}
