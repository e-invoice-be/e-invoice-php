<?php

declare(strict_types=1);

namespace EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * An item-level attribute (BG-32 / BT-160 + BT-161) from cac:AdditionalItemProperty.
 *
 * @phpstan-type ItemAttributeShape = array{name: string, value?: string|null}
 */
final class ItemAttribute implements BaseModel
{
    /** @use SdkModel<ItemAttributeShape> */
    use SdkModel;

    /**
     * Attribute name (BT-160).
     */
    #[Required]
    public string $name;

    /**
     * Attribute value (BT-161).
     */
    #[Optional(nullable: true)]
    public ?string $value;

    /**
     * `new ItemAttribute()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * ItemAttribute::with(name: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new ItemAttribute)->withName(...)
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
     */
    public static function with(string $name, ?string $value = null): self
    {
        $self = new self;

        $self['name'] = $name;

        null !== $value && $self['value'] = $value;

        return $self;
    }

    /**
     * Attribute name (BT-160).
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Attribute value (BT-161).
     */
    public function withValue(?string $value): self
    {
        $self = clone $this;
        $self['value'] = $value;

        return $self;
    }
}
