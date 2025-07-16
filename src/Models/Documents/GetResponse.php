<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string                  $id                   `required`
     * @param string                  $fileName             `required`
     * @param null|string             $fileHash
     * @param null|int                $fileSize
     * @param null|string             $receiverPeppolID
     * @param null|string             $receiverPeppolScheme
     * @param null|string             $senderPeppolID
     * @param null|string             $senderPeppolScheme
     * @param null|string             $signedURL
     * @param null|\DateTimeInterface $validatedAt
     */
    final public function __construct(
        $id,
        $fileName,
        $fileHash = None::NOT_GIVEN,
        $fileSize = None::NOT_GIVEN,
        $receiverPeppolID = None::NOT_GIVEN,
        $receiverPeppolScheme = None::NOT_GIVEN,
        $senderPeppolID = None::NOT_GIVEN,
        $senderPeppolScheme = None::NOT_GIVEN,
        $signedURL = None::NOT_GIVEN,
        $validatedAt = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

GetResponse::_loadMetadata();
