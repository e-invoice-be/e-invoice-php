<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\Documents;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

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
     * @var mixed|null $validatedAt
     */
    #[Api('validated_at', optional: true)]
    public mixed $validatedAt;

    /**
     * @param string|null $fileHash
     * @param int         $fileSize
     * @param string|null $receiverPeppolID
     * @param string|null $receiverPeppolScheme
     * @param string|null $senderPeppolID
     * @param string|null $senderPeppolScheme
     * @param string|null $signedURL
     * @param mixed|null  $validatedAt
     */
    final public function __construct(
        string $id,
        string $fileName,
        string|None|null $fileHash = None::NOT_SET,
        int|None $fileSize = None::NOT_SET,
        string|None|null $receiverPeppolID = None::NOT_SET,
        string|None|null $receiverPeppolScheme = None::NOT_SET,
        string|None|null $senderPeppolID = None::NOT_SET,
        string|None|null $senderPeppolScheme = None::NOT_SET,
        string|None|null $signedURL = None::NOT_SET,
        mixed $validatedAt = None::NOT_SET,
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
