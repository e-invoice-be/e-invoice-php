<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Webhooks;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Model for webhook deletion.
 *
 * @phpstan-type webhook_delete_response_alias = array{isDeleted: bool}
 */
final class WebhookDeleteResponse implements BaseModel
{
    use Model;

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
        self::introspect();
        $this->unsetOptionalProperties();
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
