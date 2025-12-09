<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue\Type;

/**
 * @phpstan-type UblDocumentValidationShape = array{
 *   id: string,
 *   fileName: string|null,
 *   isValid: bool,
 *   issues: list<Issue>,
 *   ublDocument?: string|null,
 * }
 */
final class UblDocumentValidation implements BaseModel
{
    /** @use SdkModel<UblDocumentValidationShape> */
    use SdkModel;

    #[Required]
    public string $id;

    #[Required('file_name')]
    public ?string $fileName;

    #[Required('is_valid')]
    public bool $isValid;

    /** @var list<Issue> $issues */
    #[Required(list: Issue::class)]
    public array $issues;

    #[Optional('ubl_document', nullable: true)]
    public ?string $ublDocument;

    /**
     * `new UblDocumentValidation()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * UblDocumentValidation::with(id: ..., fileName: ..., isValid: ..., issues: ...)
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
     * @param list<Issue|array{
     *   message: string,
     *   schematron: string,
     *   type: value-of<Type>,
     *   flag?: string|null,
     *   location?: string|null,
     *   ruleID?: string|null,
     *   test?: string|null,
     * }> $issues
     */
    public static function with(
        string $id,
        ?string $fileName,
        bool $isValid,
        array $issues,
        ?string $ublDocument = null,
    ): self {
        $obj = new self;

        $obj['id'] = $id;
        $obj['fileName'] = $fileName;
        $obj['isValid'] = $isValid;
        $obj['issues'] = $issues;

        null !== $ublDocument && $obj['ublDocument'] = $ublDocument;

        return $obj;
    }

    public function withID(string $id): self
    {
        $obj = clone $this;
        $obj['id'] = $id;

        return $obj;
    }

    public function withFileName(?string $fileName): self
    {
        $obj = clone $this;
        $obj['fileName'] = $fileName;

        return $obj;
    }

    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj['isValid'] = $isValid;

        return $obj;
    }

    /**
     * @param list<Issue|array{
     *   message: string,
     *   schematron: string,
     *   type: value-of<Type>,
     *   flag?: string|null,
     *   location?: string|null,
     *   ruleID?: string|null,
     *   test?: string|null,
     * }> $issues
     */
    public function withIssues(array $issues): self
    {
        $obj = clone $this;
        $obj['issues'] = $issues;

        return $obj;
    }

    public function withUblDocument(?string $ublDocument): self
    {
        $obj = clone $this;
        $obj['ublDocument'] = $ublDocument;

        return $obj;
    }
}
