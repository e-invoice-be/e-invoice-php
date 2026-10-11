<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkParams;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Stats\StatRetrieveParams\Aggregation;

/**
 * Retrieve usage statistics for billing purposes. Returns statistics for document sent and document received actions, grouped by aggregation period (day/week/month). If no date parameters are provided, returns daily stats for all available data.
 *
 * @see EInvoiceAPI\Services\StatsService::retrieve()
 *
 * @phpstan-type StatRetrieveParamsShape = array{
 *   aggregation?: null|Aggregation|value-of<Aggregation>,
 *   endDate?: string|null,
 *   startDate?: string|null,
 * }
 */
final class StatRetrieveParams implements BaseModel
{
    /** @use SdkModel<StatRetrieveParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * Aggregation type: DAY, WEEK, or MONTH. Defaults to DAY.
     *
     * @var value-of<Aggregation>|null $aggregation
     */
    #[Optional(enum: Aggregation::class, nullable: true)]
    public ?string $aggregation;

    /**
     * End date in yyyy-mm-dd format. If not provided, queries to latest available data.
     */
    #[Optional(nullable: true)]
    public ?string $endDate;

    /**
     * Start date in yyyy-mm-dd format. If not provided, queries from earliest available data.
     */
    #[Optional(nullable: true)]
    public ?string $startDate;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Aggregation|value-of<Aggregation>|null $aggregation
     */
    public static function with(
        Aggregation|string|null $aggregation = null,
        ?string $endDate = null,
        ?string $startDate = null,
    ): self {
        $self = new self;

        null !== $aggregation && $self['aggregation'] = $aggregation;
        null !== $endDate && $self['endDate'] = $endDate;
        null !== $startDate && $self['startDate'] = $startDate;

        return $self;
    }

    /**
     * Aggregation type: DAY, WEEK, or MONTH. Defaults to DAY.
     *
     * @param Aggregation|value-of<Aggregation>|null $aggregation
     */
    public function withAggregation(Aggregation|string|null $aggregation): self
    {
        $self = clone $this;
        $self['aggregation'] = $aggregation;

        return $self;
    }

    /**
     * End date in yyyy-mm-dd format. If not provided, queries to latest available data.
     */
    public function withEndDate(?string $endDate): self
    {
        $self = clone $this;
        $self['endDate'] = $endDate;

        return $self;
    }

    /**
     * Start date in yyyy-mm-dd format. If not provided, queries from earliest available data.
     */
    public function withStartDate(?string $startDate): self
    {
        $self = clone $this;
        $self['startDate'] = $startDate;

        return $self;
    }
}
