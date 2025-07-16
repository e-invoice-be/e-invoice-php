<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class GetResponse implements BaseModel
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
        $this->fileHash = $fileHash;
        $this->fileSize = $fileSize;
        $this->receiverPeppolID = $receiverPeppolID;
        $this->receiverPeppolScheme = $receiverPeppolScheme;
        $this->senderPeppolID = $senderPeppolID;
        $this->senderPeppolScheme = $senderPeppolScheme;
        $this->signedURL = $signedURL;
        $this->validatedAt = $validatedAt;
    }
}

GetResponse::_loadMetadata();
