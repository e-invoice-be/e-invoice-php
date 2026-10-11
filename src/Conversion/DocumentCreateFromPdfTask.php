<?php

declare(strict_types=1);

namespace EInvoiceAPI\Conversion;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * @phpstan-type DocumentCreateFromPdfTaskShape = array{
 *   taskID: string, status?: value-of<DocumentCreateFromPdfTaskStatus>|null
 * }
 */
final class DocumentCreateFromPdfTask implements BaseModel
{
    /** @use SdkModel<DocumentCreateFromPdfTaskShape> */
    use SdkModel;

    /**
     * The ID of the task that will process the PDF.
     */
    #[Required('task_id')]
    public string $taskID;

    /**
     * The status of the task.
     *
     * @var value-of<DocumentCreateFromPdfTaskStatus>|null $status
     */
    #[Optional(enum: DocumentCreateFromPdfTaskStatus::class)]
    public ?string $status;

    /**
     * `new DocumentCreateFromPdfTask()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentCreateFromPdfTask::with(taskID: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentCreateFromPdfTask)->withTaskID(...)
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
     * @param DocumentCreateFromPdfTaskStatus|value-of<DocumentCreateFromPdfTaskStatus> $status
     */
    public static function with(
        string $taskID,
        DocumentCreateFromPdfTaskStatus|string|null $status = null
    ): self {
        $self = new self;

        $self['taskID'] = $taskID;

        null !== $status && $self['status'] = $status;

        return $self;
    }

    /**
     * The ID of the task that will process the PDF.
     */
    public function withTaskID(string $taskID): self
    {
        $self = clone $this;
        $self['taskID'] = $taskID;

        return $self;
    }

    /**
     * The status of the task.
     *
     * @param DocumentCreateFromPdfTaskStatus|value-of<DocumentCreateFromPdfTaskStatus> $status
     */
    public function withStatus(
        DocumentCreateFromPdfTaskStatus|string $status
    ): self {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }
}
