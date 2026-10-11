<?php

declare(strict_types=1);

namespace EInvoiceAPI\Stats\StatGetResponse;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;

/**
 * Statistics for a specific action in a specific time period.
 *
 * @phpstan-type ActionShape = array{
 *   action: value-of<Action\Action>, count: int, statDate: \DateTimeInterface
 * }
 */
final class Action implements BaseModel
{
    /** @use SdkModel<ActionShape> */
    use SdkModel;

    /**
     * Type of action.
     *
     * @var value-of<Action\Action> $action
     */
    #[Required(enum: Action\Action::class)]
    public string $action;

    /**
     * Number of occurrences of this action in this period.
     */
    #[Required]
    public int $count;

    /**
     * The date/period this stat represents. For DAY aggregation this is the specific day, for WEEK it's the start of the week, for MONTH it's the first day of the month.
     */
    #[Required('stat_date')]
    public \DateTimeInterface $statDate;

    /**
     * `new Action()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Action::with(action: ..., count: ..., statDate: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Action)->withAction(...)->withCount(...)->withStatDate(...)
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
     * @param Action\Action|value-of<Action\Action> $action
     */
    public static function with(
        Action\Action|string $action,
        int $count,
        \DateTimeInterface $statDate
    ): self {
        $self = new self;

        $self['action'] = $action;
        $self['count'] = $count;
        $self['statDate'] = $statDate;

        return $self;
    }

    /**
     * Type of action.
     *
     * @param Action\Action|value-of<Action\Action> $action
     */
    public function withAction(Action\Action|string $action): self
    {
        $self = clone $this;
        $self['action'] = $action;

        return $self;
    }

    /**
     * Number of occurrences of this action in this period.
     */
    public function withCount(int $count): self
    {
        $self = clone $this;
        $self['count'] = $count;

        return $self;
    }

    /**
     * The date/period this stat represents. For DAY aggregation this is the specific day, for WEEK it's the start of the week, for MONTH it's the first day of the month.
     */
    public function withStatDate(\DateTimeInterface $statDate): self
    {
        $self = clone $this;
        $self['statDate'] = $statDate;

        return $self;
    }
}
