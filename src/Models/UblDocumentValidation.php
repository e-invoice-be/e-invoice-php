<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;

class UblDocumentValidation implements BaseModel
{
    use Model;

    #[Api]
    public string $id;

    #[Api('file_name')]
    public ?string $fileName;

    #[Api('is_valid')]
    public bool $isValid;

    /**
     * @var list<array{
     *   message?: string,
     *   schematron?: string,
     *   type?: string,
     *   flag?: string|null,
     *   location?: string|null,
     *   ruleID?: string|null,
     *   test?: string|null,
     * }> $issues
     */
    #[Api(type: new ListOf(new ListOf('mixed')))]
    public array $issues;

    #[Api('ubl_document', optional: true)]
    public ?string $ublDocument;

    /**
     * @param string      $id
     * @param null|string $fileName
     * @param bool        $isValid
     * @param list<array{
     *   message?: string,
     *   schematron?: string,
     *   type?: string,
     *   flag?: string|null,
     *   location?: string|null,
     *   ruleID?: string|null,
     *   test?: string|null,
     * }> $issues
     * @param null|string $ublDocument
     */
    final public function __construct(
        $id,
        $fileName,
        $isValid,
        $issues,
        $ublDocument = None::NOT_GIVEN
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

UblDocumentValidation::_loadMetadata();
