<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue;

/**
 * @phpstan-type ubl_document_validation_alias = array{
 *   id: string,
 *   fileName: string|null,
 *   isValid: bool,
 *   issues: list<Issue>,
 *   ublDocument?: string|null,
 * }
 */
final class UblDocumentValidation implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public ?string $fileName;

    #[Api('is_valid')]
    public bool $isValid;

    /** @var list<Issue> $issues */
    #[Api(type: new ListOf(Issue::class))]
    public array $issues;

    #[Api('ubl_document', optional: true)]
    public ?string $ublDocument;

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
    public static function from(
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

    public function setID(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setFileName(?string $fileName): self
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * @param list<Issue> $issues
     */
    public function setIssues(array $issues): self
    {
        $this->issues = $issues;

        return $this;
    }

    public function setUblDocument(?string $ublDocument): self
    {
        $this->ublDocument = $ublDocument;

        return $this;
    }
}
