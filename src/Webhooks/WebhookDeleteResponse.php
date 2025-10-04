<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;

/**
 * Model for webhook deletion.
 *
 * @phpstan-type webhook_delete_response = array{isDeleted: bool}
 */
final class WebhookDeleteResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<webhook_delete_response> */
    use SdkModel;

    use SdkResponse;

    #[Api('is_deleted')]
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
        $obj = new self;

        $obj->isDeleted = $isDeleted;

        return $obj;
    }

    public function withIsDeleted(bool $isDeleted): self
    {
        $obj = clone $this;
        $obj->isDeleted = $isDeleted;

        return $obj;
    }
}
