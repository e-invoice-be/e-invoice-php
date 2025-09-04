<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\Attachments;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * An object containing the method's parameters.
 * Example usage:
 * ```
 * $params = (new AttachmentAddParams); // set properties as needed
 * $client->documents.attachments->add(...$params->toArray());
 * ```
 * Add a new attachment to an invoice or credit note.
 *
 * @method toArray()
 *   Returns the parameters as an associative array suitable for passing to the client method.
 *
 *   `$client->documents.attachments->add(...$params->toArray());`
 *
 * @see EInvoiceAPI\Documents\Attachments->add
 *
 * @phpstan-type attachment_add_params = array{file: string}
 */
final class AttachmentAddParams implements BaseModel
{
    /** @use SdkModel<attachment_add_params> */
    use SdkModel;
    use SdkParams;

    #[Api]
    public string $file;

    /**
     * `new AttachmentAddParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * AttachmentAddParams::with(file: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new AttachmentAddParams)->withFile(...)
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
    public static function with(string $file): self
    {
        $obj = new self;

        $obj->file = $file;

        return $obj;
    }

    public function withFile(string $file): self
    {
        $obj = clone $this;
        $obj->file = $file;

        return $obj;
    }
}
