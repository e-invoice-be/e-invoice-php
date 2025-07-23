<?php

declare(strict_types=1);

namespace EInvoiceAPI\Parameters\Documents;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Concerns\Params;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Delete an attachment from an invoice or credit note.
 *
 * @phpstan-type delete_params = array{documentID: string}
 */
final class AttachmentDeleteParam implements BaseModel
{
    use Model;
    use Params;

    #[Api]
    public string $documentID;

    /**
     * You must use named parameters to construct this object.
     */
    final public function __construct(string $documentID)
    {
        self::introspect();

        $this->documentID = $documentID;
    }
}
