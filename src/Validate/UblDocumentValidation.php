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
        $self = new self;

        $self['id'] = $id;
        $self['fileName'] = $fileName;
        $self['isValid'] = $isValid;
        $self['issues'] = $issues;

        null !== $ublDocument && $self['ublDocument'] = $ublDocument;

        return $self;
    }

    public function withID(string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    public function withFileName(?string $fileName): self
    {
        $self = clone $this;
        $self['fileName'] = $fileName;

        return $self;
    }

    public function withIsValid(bool $isValid): self
    {
        $self = clone $this;
        $self['isValid'] = $isValid;

        return $self;
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
        $self = clone $this;
        $self['issues'] = $issues;

        return $self;
    }

    public function withUblDocument(?string $ublDocument): self
    {
        $self = clone $this;
        $self['ublDocument'] = $ublDocument;

        return $self;
    }
}
