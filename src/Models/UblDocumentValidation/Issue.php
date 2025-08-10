<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\UblDocumentValidation;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Models\UblDocumentValidation\Issue\Type;

/**
 * @phpstan-type issue_alias = array{
 *   message: string,
 *   schematron: string,
 *   type: Type::*,
 *   flag?: string|null,
 *   location?: string|null,
 *   ruleID?: string|null,
 *   test?: string|null,
 * }
 */
final class Issue implements BaseModel
{
    use Model;

    #[Api]
    public string $message;

    #[Api]
    public string $schematron;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(optional: true)]
    public ?string $flag;

    #[Api(optional: true)]
    public ?string $location;

    #[Api('rule_id', optional: true)]
    public ?string $ruleID;

    #[Api(optional: true)]
    public ?string $test;

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
     * @param Type::* $type
     */
    public static function new(
        string $message,
        string $schematron,
        string $type,
        ?string $flag = null,
        ?string $location = null,
        ?string $ruleID = null,
        ?string $test = null,
    ): self {
        $obj = new self;

        $obj->message = $message;
        $obj->schematron = $schematron;
        $obj->type = $type;

        null !== $flag && $obj->flag = $flag;
        null !== $location && $obj->location = $location;
        null !== $ruleID && $obj->ruleID = $ruleID;
        null !== $test && $obj->test = $test;

        return $obj;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function setSchematron(string $schematron): self
    {
        $this->schematron = $schematron;

        return $this;
    }

    /**
     * @param Type::* $type
     */
    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }

    public function setLocation(?string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function setRuleID(?string $ruleID): self
    {
        $this->ruleID = $ruleID;

        return $this;
    }

    public function setTest(?string $test): self
    {
        $this->test = $test;

        return $this;
    }
}
