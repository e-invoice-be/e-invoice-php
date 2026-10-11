<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\MapOf;

/**
 * @phpstan-type WebhookGetHistoryResponseShape = array{
 *   history: list<array<string,mixed>>
 * }
 */
final class WebhookGetHistoryResponse implements BaseModel
{
    /** @use SdkModel<WebhookGetHistoryResponseShape> */
    use SdkModel;

    /** @var list<array<string,mixed>> $history */
    #[Required(list: new MapOf('mixed'))]
    public array $history;

    /**
     * `new WebhookGetHistoryResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookGetHistoryResponse::with(history: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookGetHistoryResponse)->withHistory(...)
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
     *
     * @param list<array<string,mixed>> $history
     */
    public static function with(array $history): self
    {
        $self = new self;

        $self['history'] = $history;

        return $self;
    }

    /**
     * @param list<array<string,mixed>> $history
     */
    public function withHistory(array $history): self
    {
        $self = clone $this;
        $self['history'] = $history;

        return $self;
    }
}
