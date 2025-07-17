<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\UblDocumentValidation\Issue\Type;

final class Issue implements BaseModel
{
    use Model;

    #[Api]
    public string $message;

    #[Api]
    public string $schematron;

    /** @var Type::* $type */
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
     * You must use named parameters to construct this object.
     *
     * @param Type::* $type
     */
    final public function __construct(
        string $message,
        string $schematron,
        string $type,
        ?string $flag = null,
        ?string $location = null,
        ?string $ruleID = null,
        ?string $test = null,
    ) {
        $this->message = $message;
        $this->schematron = $schematron;
        $this->type = $type;

        self::_introspect();
        $this->unsetOptionalProperties();

        null != $flag && $this->flag = $flag;
        null != $location && $this->location = $location;
        null != $ruleID && $this->ruleID = $ruleID;
        null != $test && $this->test = $test;
    }
}
