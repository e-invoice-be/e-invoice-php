<?php

declare(strict_types=1);

namespace EInvoiceAPI\Mailbox;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Download a specific attachment from an inbound email by filename. Returns the binary content with the correct Content-Type.
 *
 * @see EInvoiceAPI\Services\MailboxService::downloadAttachment()
 *
 * @phpstan-type MailboxDownloadAttachmentParamsShape = array{
 *   inboundEmailID: string
 * }
 */
final class MailboxDownloadAttachmentParams implements BaseModel
{
    /** @use SdkModel<MailboxDownloadAttachmentParamsShape> */
    use SdkModel;
    use SdkParams;

    #[Required]
    public string $inboundEmailID;

    /**
     * `new MailboxDownloadAttachmentParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * MailboxDownloadAttachmentParams::with(inboundEmailID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new MailboxDownloadAttachmentParams)->withInboundEmailID(...)
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
    public static function with(string $inboundEmailID): self
    {
        $self = new self;

        $self['inboundEmailID'] = $inboundEmailID;

        return $self;
    }

    public function withInboundEmailID(string $inboundEmailID): self
    {
        $self = clone $this;
        $self['inboundEmailID'] = $inboundEmailID;

        return $self;
    }
}
