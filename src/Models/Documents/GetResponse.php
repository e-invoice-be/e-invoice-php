<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

class GetResponse implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public string $fileName;

    #[Api('file_hash', optional: true)]
    public ?string $fileHash;

    #[Api('file_size', optional: true)]
    public int $fileSize;

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

    /**
     * @var null|mixed $validatedAt
     */
    #[Api('validated_at', optional: true)]
    public mixed $validatedAt;

    /**
     * @param null|string $fileHash
     * @param int         $fileSize
     * @param null|string $receiverPeppolID
     * @param null|string $receiverPeppolScheme
     * @param null|string $senderPeppolID
     * @param null|string $senderPeppolScheme
     * @param null|string $signedURL
     * @param null|mixed  $validatedAt
     */
    final public function __construct(
        string $id,
        string $fileName,
        null|None|string $fileHash = None::NOT_SET,
        int|None $fileSize = None::NOT_SET,
        null|None|string $receiverPeppolID = None::NOT_SET,
        null|None|string $receiverPeppolScheme = None::NOT_SET,
        null|None|string $senderPeppolID = None::NOT_SET,
        null|None|string $senderPeppolScheme = None::NOT_SET,
        null|None|string $signedURL = None::NOT_SET,
        mixed $validatedAt = None::NOT_SET
    ) {
        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);
    }
}

GetResponse::_loadMetadata();
