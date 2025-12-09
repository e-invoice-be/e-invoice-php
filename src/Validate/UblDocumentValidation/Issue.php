<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\UblDocumentValidation;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Validate\UblDocumentValidation\Issue\Type;

/**
 * @phpstan-type IssueShape = array{
 *   message: string,
 *   schematron: string,
 *   type: value-of<Type>,
 *   flag?: string|null,
 *   location?: string|null,
 *   rule_id?: string|null,
 *   test?: string|null,
 * }
 */
final class Issue implements BaseModel
{
    /** @use SdkModel<IssueShape> */
    use SdkModel;

    #[Required]
    public string $message;

    #[Required]
    public string $schematron;

    /** @var value-of<Type> $type */
    #[Required(enum: Type::class)]
    public string $type;

    #[Optional(nullable: true)]
    public ?string $flag;

    #[Optional(nullable: true)]
    public ?string $location;

    #[Optional(nullable: true)]
    public ?string $rule_id;

    #[Optional(nullable: true)]
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
     * @param Type|value-of<Type> $type
     */
    public static function with(
        string $message,
        string $schematron,
        Type|string $type,
        ?string $flag = null,
        ?string $location = null,
        ?string $rule_id = null,
        ?string $test = null,
    ): self {
        $obj = new self;

        $obj['message'] = $message;
        $obj['schematron'] = $schematron;
        $obj['type'] = $type;

        null !== $flag && $obj['flag'] = $flag;
        null !== $location && $obj['location'] = $location;
        null !== $rule_id && $obj['rule_id'] = $rule_id;
        null !== $test && $obj['test'] = $test;

        return $obj;
    }

    public function withMessage(string $message): self
    {
        $obj = clone $this;
        $obj['message'] = $message;

        return $obj;
    }

    public function withSchematron(string $schematron): self
    {
        $obj = clone $this;
        $obj['schematron'] = $schematron;

        return $obj;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $obj = clone $this;
        $obj['type'] = $type;

        return $obj;
    }

    public function withFlag(?string $flag): self
    {
        $obj = clone $this;
        $obj['flag'] = $flag;

        return $obj;
    }

    public function withLocation(?string $location): self
    {
        $obj = clone $this;
        $obj['location'] = $location;

        return $obj;
    }

    public function withRuleID(?string $ruleID): self
    {
        $obj = clone $this;
        $obj['rule_id'] = $ruleID;

        return $obj;
    }

    public function withTest(?string $test): self
    {
        $obj = clone $this;
        $obj['test'] = $test;

        return $obj;
    }
}
