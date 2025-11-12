<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue;

/**
 * @phpstan-type UblDocumentValidationShape = array{
 *   id: string,
 *   file_name: string|null,
 *   is_valid: bool,
 *   issues: list<Issue>,
 *   ubl_document?: string|null,
 * }
 */
final class UblDocumentValidation implements BaseModel, ResponseConverter
{
    /** @use SdkModel<UblDocumentValidationShape> */
    use SdkModel;

    use SdkResponse;

    #[Api]
    public string $id;

    #[Api]
    public ?string $file_name;

    #[Api]
    public bool $is_valid;

    /** @var list<Issue> $issues */
    #[Api(list: Issue::class)]
    public array $issues;

    #[Api(nullable: true, optional: true)]
    public ?string $ubl_document;

    /**
     * `new UblDocumentValidation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UblDocumentValidation::with(id: ..., file_name: ..., is_valid: ..., issues: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new UblDocumentValidation)
     *   ->withID(...)
     *   ->withFileName(...)
     *   ->withIsValid(...)
     *   ->withIssues(...)
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
     * @param list<Issue> $issues
     */
    public static function with(
        string $id,
        ?string $file_name,
        bool $is_valid,
        array $issues,
        ?string $ubl_document = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->file_name = $file_name;
        $obj->is_valid = $is_valid;
        $obj->issues = $issues;

        null !== $ubl_document && $obj->ubl_document = $ubl_document;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj->id = $id;

        return $obj;
    }

    public function withFileName(?string $fileName): self
    {
        $obj = clone $this;
        $obj->file_name = $fileName;

        return $obj;
    }

    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj->is_valid = $isValid;

        return $obj;
    }

    /**
     * @param list<Issue> $issues
     */
    public function withIssues(array $issues): self
    {
        $obj = clone $this;
        $obj->issues = $issues;

        return $obj;
    }

    public function withUblDocument(?string $ublDocument): self
    {
        $obj = clone $this;
        $obj->ubl_document = $ublDocument;

        return $obj;
    }
}
