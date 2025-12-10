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
 *   ruleID?: string|null,
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

    #[Optional('rule_id', nullable: true)]
    public ?string $ruleID;

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
        ?string $ruleID = null,
        ?string $test = null,
    ): self {
        $self = new self;

        $self['message'] = $message;
        $self['schematron'] = $schematron;
        $self['type'] = $type;

        null !== $flag && $self['flag'] = $flag;
        null !== $location && $self['location'] = $location;
        null !== $ruleID && $self['ruleID'] = $ruleID;
        null !== $test && $self['test'] = $test;

        return $self;
    }

    public function withMessage(string $message): self
    {
        $self = clone $this;
        $self['message'] = $message;

        return $self;
    }

    public function withSchematron(string $schematron): self
    {
        $self = clone $this;
        $self['schematron'] = $schematron;

        return $self;
    }

    /**
     * @param Type|value-of<Type> $type
     */
    public function withType(Type|string $type): self
    {
        $self = clone $this;
        $self['type'] = $type;

        return $self;
    }

    public function withFlag(?string $flag): self
    {
        $self = clone $this;
        $self['flag'] = $flag;

        return $self;
    }

    public function withLocation(?string $location): self
    {
        $self = clone $this;
        $self['location'] = $location;

        return $self;
    }

    public function withRuleID(?string $ruleID): self
    {
        $self = clone $this;
        $self['ruleID'] = $ruleID;

        return $self;
    }

    public function withTest(?string $test): self
    {
        $self = clone $this;
        $self['test'] = $test;

        return $self;
    }
}
