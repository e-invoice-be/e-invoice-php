<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue;

final class UblDocumentValidation implements BaseModel
{
    use SdkModel;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public ?string $fileName;

    #[Api('is_valid')]
    public bool $isValid;

    /** @var list<Issue> $issues */
    #[Api(list: Issue::class)]
    public array $issues;

    #[Api('ubl_document', nullable: true, optional: true)]
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
        self::introspect();
        $this->unsetOptionalProperties();
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
        ?string $fileName,
        bool $isValid,
        array $issues,
        ?string $ublDocument = null,
    ): self {
        $obj = new self;

        $obj->id = $id;
        $obj->fileName = $fileName;
        $obj->isValid = $isValid;
        $obj->issues = $issues;

        null !== $ublDocument && $obj->ublDocument = $ublDocument;

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
        $obj->fileName = $fileName;

        return $obj;
    }

    public function withIsValid(bool $isValid): self
    {
        $obj = clone $this;
        $obj->isValid = $isValid;

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
        $obj->ublDocument = $ublDocument;

        return $obj;
    }
}
