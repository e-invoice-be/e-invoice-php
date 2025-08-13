<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Delete an attachment from an invoice or credit note.
 *
 * @phpstan-type delete_params = array{documentID: string}
 */
final class AttachmentDeleteParams implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $documentID;

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
    public static function from(string $documentID): self
    {
        $obj = new self;

        $obj->documentID = $documentID;

        return $obj;
    }

    public function setDocumentID(string $documentID): self
    {
        $this->documentID = $documentID;

        return $this;
    }
}
