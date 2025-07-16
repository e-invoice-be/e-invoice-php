<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;

final class Issue implements BaseModel
{
    use Model;

    #[Api]
    public string $message;

    #[Api]
    public string $schematron;

    #[Api]
    public string $type;

    #[Api(optional: true)]
    public ?string $flag;

    #[Api(optional: true)]
    public ?string $location;

    #[Api('rule_id', optional: true)]
    public ?string $ruleID;

    #[Api(optional: true)]
    public ?string $test;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string      $message    `required`
     * @param string      $schematron `required`
     * @param string      $type       `required`
     * @param null|string $flag
     * @param null|string $location
     * @param null|string $ruleID
     * @param null|string $test
     */
    final public function __construct(
        $message,
        $schematron,
        $type,
        $flag = None::NOT_GIVEN,
        $location = None::NOT_GIVEN,
        $ruleID = None::NOT_GIVEN,
        $test = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Issue::_loadMetadata();
