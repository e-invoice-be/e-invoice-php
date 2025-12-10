<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Model for webhook deletion.
 *
 * @phpstan-type WebhookDeleteResponseShape = array{isDeleted: bool}
 */
final class WebhookDeleteResponse implements BaseModel
{
    /** @use SdkModel<WebhookDeleteResponseShape> */
    use SdkModel;

    #[Required('is_deleted')]
    public bool $isDeleted;

    /**
     * `new WebhookDeleteResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookDeleteResponse::with(isDeleted: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookDeleteResponse)->withIsDeleted(...)
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
    public static function with(bool $isDeleted): self
    {
        $self = new self;

        $self['isDeleted'] = $isDeleted;

        return $self;
    }

    public function withIsDeleted(bool $isDeleted): self
    {
        $self = clone $this;
        $self['isDeleted'] = $isDeleted;

        return $self;
    }
}
