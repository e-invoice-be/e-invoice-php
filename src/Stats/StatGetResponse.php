<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Stats\StatGetResponse\Action;
use EInvoiceAPI\Stats\StatGetResponse\Aggregation;

/**
 * Statistics response for a tenant.
 *
 * @phpstan-type StatGetResponseShape = array{
 *   actions: list<Action>,
 *   aggregation: value-of<Aggregation>,
 *   averageDailyUsage: float,
 *   periodEnd: \DateTimeInterface,
 *   periodStart: \DateTimeInterface,
 *   tenantID: string,
 *   totalDays: int,
 *   budgetEstimationDays?: float|null,
 * }
 */
final class StatGetResponse implements BaseModel
{
    /** @use SdkModel<StatGetResponseShape> */
    use SdkModel;

    /**
     * List of action statistics, one entry per aggregation period per action.
     *
     * @var list<Action> $actions
     */
    #[Required(list: Action::class)]
    public array $actions;

    /**
     * Aggregation type used.
     *
     * @var value-of<Aggregation> $aggregation
     */
    #[Required(enum: Aggregation::class)]
    public string $aggregation;

    /**
     * Average daily usage (total actions / total days).
     */
    #[Required('average_daily_usage')]
    public float $averageDailyUsage;

    /**
     * End date of the period.
     */
    #[Required('period_end')]
    public \DateTimeInterface $periodEnd;

    /**
     * Start date of the period.
     */
    #[Required('period_start')]
    public \DateTimeInterface $periodStart;

    /**
     * Tenant ID.
     */
    #[Required('tenant_id')]
    public string $tenantID;

    /**
     * Number of days in the period.
     */
    #[Required('total_days')]
    public int $totalDays;

    /**
     * Estimated days until credits run out (credit_balance / average_daily_usage). 0.0 if average_daily_usage is 0 or credit_balance is None.
     */
    #[Optional('budget_estimation_days')]
    public ?float $budgetEstimationDays;

    /**
     * `new StatGetResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * StatGetResponse::with(
     *   actions: ...,
     *   aggregation: ...,
     *   averageDailyUsage: ...,
     *   periodEnd: ...,
     *   periodStart: ...,
     *   tenantID: ...,
     *   totalDays: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new StatGetResponse)
     *   ->withActions(...)
     *   ->withAggregation(...)
     *   ->withAverageDailyUsage(...)
     *   ->withPeriodEnd(...)
     *   ->withPeriodStart(...)
     *   ->withTenantID(...)
     *   ->withTotalDays(...)
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
     * @param list<Action|array{
     *   action: value-of<Action\Action>,
     *   count: int,
     *   statDate: \DateTimeInterface,
     * }> $actions
     * @param Aggregation|value-of<Aggregation> $aggregation
     */
    public static function with(
        array $actions,
        Aggregation|string $aggregation,
        float $averageDailyUsage,
        \DateTimeInterface $periodEnd,
        \DateTimeInterface $periodStart,
        string $tenantID,
        int $totalDays,
        ?float $budgetEstimationDays = null,
    ): self {
        $self = new self;

        $self['actions'] = $actions;
        $self['aggregation'] = $aggregation;
        $self['averageDailyUsage'] = $averageDailyUsage;
        $self['periodEnd'] = $periodEnd;
        $self['periodStart'] = $periodStart;
        $self['tenantID'] = $tenantID;
        $self['totalDays'] = $totalDays;

        null !== $budgetEstimationDays && $self['budgetEstimationDays'] = $budgetEstimationDays;

        return $self;
    }

    /**
     * List of action statistics, one entry per aggregation period per action.
     *
     * @param list<Action|array{
     *   action: value-of<Action\Action>,
     *   count: int,
     *   statDate: \DateTimeInterface,
     * }> $actions
     */
    public function withActions(array $actions): self
    {
        $self = clone $this;
        $self['actions'] = $actions;

        return $self;
    }

    /**
     * Aggregation type used.
     *
     * @param Aggregation|value-of<Aggregation> $aggregation
     */
    public function withAggregation(Aggregation|string $aggregation): self
    {
        $self = clone $this;
        $self['aggregation'] = $aggregation;

        return $self;
    }

    /**
     * Average daily usage (total actions / total days).
     */
    public function withAverageDailyUsage(float $averageDailyUsage): self
    {
        $self = clone $this;
        $self['averageDailyUsage'] = $averageDailyUsage;

        return $self;
    }

    /**
     * End date of the period.
     */
    public function withPeriodEnd(\DateTimeInterface $periodEnd): self
    {
        $self = clone $this;
        $self['periodEnd'] = $periodEnd;

        return $self;
    }

    /**
     * Start date of the period.
     */
    public function withPeriodStart(\DateTimeInterface $periodStart): self
    {
        $self = clone $this;
        $self['periodStart'] = $periodStart;

        return $self;
    }

    /**
     * Tenant ID.
     */
    public function withTenantID(string $tenantID): self
    {
        $self = clone $this;
        $self['tenantID'] = $tenantID;

        return $self;
    }

    /**
     * Number of days in the period.
     */
    public function withTotalDays(int $totalDays): self
    {
        $self = clone $this;
        $self['totalDays'] = $totalDays;

        return $self;
    }

    /**
     * Estimated days until credits run out (credit_balance / average_daily_usage). 0.0 if average_daily_usage is 0 or credit_balance is None.
     */
    public function withBudgetEstimationDays(float $budgetEstimationDays): self
    {
        $self = clone $this;
        $self['budgetEstimationDays'] = $budgetEstimationDays;

        return $self;
    }
}
