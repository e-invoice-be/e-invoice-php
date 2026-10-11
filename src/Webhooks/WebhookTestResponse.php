<?php

declare(strict_types=1);

namespace EInvoiceAPI\Webhooks;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Schema for webhook test response.
 *
 * @phpstan-type WebhookTestResponseShape = array{
 *   message: string, success: bool, webhookDeliveryResult: array<string,mixed>
 * }
 */
final class WebhookTestResponse implements BaseModel
{
    /** @use SdkModel<WebhookTestResponseShape> */
    use SdkModel;

    /**
     * Descriptive message about the test result.
     */
    #[Required]
    public string $message;

    /**
     * Whether the test completed successfully.
     */
    #[Required]
    public bool $success;

    /**
     * Result from process_webhook_task.
     *
     * @var array<string,mixed> $webhookDeliveryResult
     */
    #[Required('webhook_delivery_result', map: 'mixed')]
    public array $webhookDeliveryResult;

    /**
     * `new WebhookTestResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * WebhookTestResponse::with(
     *   message: ..., success: ..., webhookDeliveryResult: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new WebhookTestResponse)
     *   ->withMessage(...)
     *   ->withSuccess(...)
     *   ->withWebhookDeliveryResult(...)
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
     * @param array<string,mixed> $webhookDeliveryResult
     */
    public static function with(
        string $message,
        bool $success,
        array $webhookDeliveryResult
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['success'] = $success;
        $self['webhookDeliveryResult'] = $webhookDeliveryResult;

        return $self;
    }

    /**
     * Descriptive message about the test result.
     */
    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    /**
     * Whether the test completed successfully.
     */
    public function withSuccess(bool $success): self
    {
        $self = clone $this;
        $self['success'] = $success;

        return $self;
    }

    /**
     * Result from process_webhook_task.
     *
     * @param array<string,mixed> $webhookDeliveryResult
     */
    public function withWebhookDeliveryResult(
        array $webhookDeliveryResult
    ): self {
        $self = clone $this;
        $self['webhookDeliveryResult'] = $webhookDeliveryResult;

        return $self;
    }
}
