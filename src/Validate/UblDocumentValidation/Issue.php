<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\UblDocumentValidation;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue\Type;

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
    /** @use SdkModel<issue_alias> */
    use SdkModel;

    #[Api]
    public string $message;

    #[Api]
    public string $schematron;

    /** @var Type::* $type */
    #[Api(enum: Type::class)]
    public string $type;

    #[Api(nullable: true, optional: true)]
    public ?string $flag;

    #[Api(nullable: true, optional: true)]
    public ?string $location;

    #[Api('rule_id', nullable: true, optional: true)]
    public ?string $ruleID;

    #[Api(nullable: true, optional: true)]
    public ?string $test;

    /**
     * `new Issue()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Issue::with(message: ..., schematron: ..., type: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Issue)->withMessage(...)->withSchematron(...)->withType(...)
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
     * @param Type::* $type
     */
    public static function with(
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

    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj->message = $message;

        return $obj;
    }

    public function withSchematron(string $schematron): self
    {
        $obj = clone $this;
        $obj->schematron = $schematron;

        return $obj;
    }

    /**
     * @param Type::* $type
     */
    public function withType(string $type): self
    {
        $obj = clone $this;
        $obj->type = $type;

        return $obj;
    }

    public function withFlag(?string $flag): self
    {
        $obj = clone $this;
        $obj->flag = $flag;

        return $obj;
    }

    public function withLocation(?string $location): self
    {
        $obj = clone $this;
        $obj->location = $location;

        return $obj;
    }

    public function withRuleID(?string $ruleID): self
    {
        $obj = clone $this;
        $obj->ruleID = $ruleID;

        return $obj;
    }

    public function withTest(?string $test): self
    {
        $obj = clone $this;
        $obj->test = $test;

        return $obj;
    }
}
