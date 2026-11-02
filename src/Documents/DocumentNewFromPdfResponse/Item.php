<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentNewFromPdfResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\Allowance;
use EInvoiceAPI\Documents\Allowance\ReasonCode;
use EInvoiceAPI\Documents\Allowance\TaxCode;
use EInvoiceAPI\Documents\Charge;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse\Item\ItemAttribute;
use EInvoiceAPI\Documents\UnitOfMeasureCode;

/**
 * @phpstan-type ItemShape = array{
 *   allowances?: list<Allowance>|null,
 *   amount?: string|null,
 *   charges?: list<Charge>|null,
 *   date?: \DateTimeInterface|null,
 *   description?: string|null,
 *   itemAttributes?: list<ItemAttribute>|null,
 *   name?: string|null,
 *   priceBaseQuantity?: string,
 *   productCode?: string|null,
 *   quantity?: string|null,
 *   tax?: string|null,
 *   taxRate?: string|null,
 *   unit?: value-of<UnitOfMeasureCode>|null,
 *   unitPrice?: string|null,
 * }
 */
final class Item implements BaseModel
{
    /** @use SdkModel<ItemShape> */
    use SdkModel;

    /**
     * The allowances of the line item.
     *
     * @var list<Allowance>|null $allowances
     */
    #[Optional(list: Allowance::class, nullable: true)]
    public ?array $allowances;

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $amount;

    /**
     * The charges of the line item.
     *
     * @var list<Charge>|null $charges
     */
    #[Optional(list: Charge::class, nullable: true)]
    public ?array $charges;

    #[Optional(nullable: true)]
    public ?\DateTimeInterface $date;

    /**
     * The description of the line item (BT-154). Doubles as the item name when `name` is omitted, so a posted line item needs a `name` or a `description`. On a received document it holds the item description, or the item name (BT-153) when the document has no item description; CII documents with both combine them as `name: description`.
     */
    #[Optional(nullable: true)]
    public ?string $description;

    /**
     * Item-level attributes (BG-32) from cac:AdditionalItemProperty.
     *
     * @var list<ItemAttribute>|null $itemAttributes
     */
    #[Optional('item_attributes', list: ItemAttribute::class, nullable: true)]
    public ?array $itemAttributes;

    /**
     * The item name (BT-153), for example the product name. Written to cac:Item/cbc:Name. When omitted or blank, `description` (BT-154) is used as the item name. A posted line item needs a `name` or a `description`; a line item with neither is rejected with 422.
     */
    #[Optional(nullable: true)]
    public ?string $name;

    /**
     * The item price base quantity (BT-149). The number of item units to which the unit price applies, for example 100 when the unit price is a price for each 100 units. Must be greater than 0. Defaults to 1.
     */
    #[Optional('price_base_quantity')]
    public ?string $priceBaseQuantity;

    /**
     * The product code of the line item.
     */
    #[Optional('product_code', nullable: true)]
    public ?string $productCode;

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $quantity;

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    #[Optional(nullable: true)]
    public ?string $tax;

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    #[Optional('tax_rate', nullable: true)]
    public ?string $taxRate;

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @var value-of<UnitOfMeasureCode>|null $unit
     */
    #[Optional(enum: UnitOfMeasureCode::class, nullable: true)]
    public ?string $unit;

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     */
    #[Optional('unit_price', nullable: true)]
    public ?string $unitPrice;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     * @param list<Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<Charge\ReasonCode>|null,
     *   taxCode?: value-of<Charge\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $charges
     * @param list<ItemAttribute|array{name: string, value?: string|null}>|null $itemAttributes
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public static function with(
        ?array $allowances = null,
        ?string $amount = null,
        ?array $charges = null,
        ?\DateTimeInterface $date = null,
        ?string $description = null,
        ?array $itemAttributes = null,
        ?string $name = null,
        ?string $priceBaseQuantity = null,
        ?string $productCode = null,
        ?string $quantity = null,
        ?string $tax = null,
        ?string $taxRate = null,
        UnitOfMeasureCode|string|null $unit = null,
        ?string $unitPrice = null,
    ): self {
        $self = new self;

        null !== $allowances && $self['allowances'] = $allowances;
        null !== $amount && $self['amount'] = $amount;
        null !== $charges && $self['charges'] = $charges;
        null !== $date && $self['date'] = $date;
        null !== $description && $self['description'] = $description;
        null !== $itemAttributes && $self['itemAttributes'] = $itemAttributes;
        null !== $name && $self['name'] = $name;
        null !== $priceBaseQuantity && $self['priceBaseQuantity'] = $priceBaseQuantity;
        null !== $productCode && $self['productCode'] = $productCode;
        null !== $quantity && $self['quantity'] = $quantity;
        null !== $tax && $self['tax'] = $tax;
        null !== $taxRate && $self['taxRate'] = $taxRate;
        null !== $unit && $self['unit'] = $unit;
        null !== $unitPrice && $self['unitPrice'] = $unitPrice;

        return $self;
    }

    /**
     * The allowances of the line item.
     *
     * @param list<Allowance|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<ReasonCode>|null,
     *   taxCode?: value-of<TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $allowances
     */
    public function withAllowances(?array $allowances): self
    {
        $self = clone $this;
        $self['allowances'] = $allowances;

        return $self;
    }

    /**
     * The invoice line net amount (BT-131), exclusive of VAT, inclusive of line level allowances and charges. Calculated as: ((unit_price / price_base_quantity) * quantity) - allowances + charges. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    public function withAmount(?string $amount): self
    {
        $self = clone $this;
        $self['amount'] = $amount;

        return $self;
    }

    /**
     * The charges of the line item.
     *
     * @param list<Charge|array{
     *   amount?: string|null,
     *   baseAmount?: string|null,
     *   multiplierFactor?: string|null,
     *   reason?: string|null,
     *   reasonCode?: value-of<Charge\ReasonCode>|null,
     *   taxCode?: value-of<Charge\TaxCode>|null,
     *   taxRate?: string|null,
     * }>|null $charges
     */
    public function withCharges(?array $charges): self
    {
        $self = clone $this;
        $self['charges'] = $charges;

        return $self;
    }

    public function withDate(?\DateTimeInterface $date): self
    {
        $self = clone $this;
        $self['date'] = $date;

        return $self;
    }

    /**
     * The description of the line item (BT-154). Doubles as the item name when `name` is omitted, so a posted line item needs a `name` or a `description`. On a received document it holds the item description, or the item name (BT-153) when the document has no item description; CII documents with both combine them as `name: description`.
     */
    public function withDescription(?string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Item-level attributes (BG-32) from cac:AdditionalItemProperty.
     *
     * @param list<ItemAttribute|array{name: string, value?: string|null}>|null $itemAttributes
     */
    public function withItemAttributes(?array $itemAttributes): self
    {
        $self = clone $this;
        $self['itemAttributes'] = $itemAttributes;

        return $self;
    }

    /**
     * The item name (BT-153), for example the product name. Written to cac:Item/cbc:Name. When omitted or blank, `description` (BT-154) is used as the item name. A posted line item needs a `name` or a `description`; a line item with neither is rejected with 422.
     */
    public function withName(?string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The item price base quantity (BT-149). The number of item units to which the unit price applies, for example 100 when the unit price is a price for each 100 units. Must be greater than 0. Defaults to 1.
     */
    public function withPriceBaseQuantity(string $priceBaseQuantity): self
    {
        $self = clone $this;
        $self['priceBaseQuantity'] = $priceBaseQuantity;

        return $self;
    }

    /**
     * The product code of the line item.
     */
    public function withProductCode(?string $productCode): self
    {
        $self = clone $this;
        $self['productCode'] = $productCode;

        return $self;
    }

    /**
     * The quantity of items (goods or services) that is the subject of the line item. Must be rounded to maximum 4 decimals. Can be negative for credit notes or corrections.
     */
    public function withQuantity(?string $quantity): self
    {
        $self = clone $this;
        $self['quantity'] = $quantity;

        return $self;
    }

    /**
     * The total VAT amount for the line item. Must be rounded to maximum 2 decimals. Can be negative for credit notes or corrections.
     */
    public function withTax(?string $tax): self
    {
        $self = clone $this;
        $self['tax'] = $tax;

        return $self;
    }

    /**
     * The VAT rate of the line item expressed as percentage with 2 decimals.
     */
    public function withTaxRate(?string $taxRate): self
    {
        $self = clone $this;
        $self['taxRate'] = $taxRate;

        return $self;
    }

    /**
     * Unit of Measure Codes from UNECERec20 used in Peppol BIS Billing 3.0.
     *
     * @param UnitOfMeasureCode|value-of<UnitOfMeasureCode>|null $unit
     */
    public function withUnit(UnitOfMeasureCode|string|null $unit): self
    {
        $self = clone $this;
        $self['unit'] = $unit;

        return $self;
    }

    /**
     * The item net price (BT-146). The price of an item, exclusive of VAT, after subtracting item price discount. Must be rounded to maximum 4 decimals.
     */
    public function withUnitPrice(?string $unitPrice): self
    {
        $self = clone $this;
        $self['unitPrice'] = $unitPrice;

        return $self;
    }
}
