<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetLifecycleResponse;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\CanonicalStatus;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Direction;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Level;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Source;

/**
 * @phpstan-type EventShape = array{
 *   level: value-of<Level>,
 *   canonicalStatus: value-of<CanonicalStatus>|null,
 *   nativeCode: string|null,
 *   source: value-of<Source>,
 *   direction: value-of<Direction>,
 *   reasonCode: string|null,
 *   reason: string|null,
 *   occurredAt: \DateTimeInterface,
 * }
 */
final class Event implements BaseModel
{
    /** @use SdkModel<EventShape> */
    use SdkModel;

    /** @var value-of<Level> $level */
    #[Required(enum: Level::class)]
    public string $level;

    /** @var value-of<CanonicalStatus>|null $canonicalStatus */
    #[Required('canonical_status', enum: CanonicalStatus::class, nullable: true)]
    public ?string $canonicalStatus;

    #[Required('native_code', nullable: true)]
    public ?string $nativeCode;

    /** @var value-of<Source> $source */
    #[Required(enum: Source::class)]
    public string $source;

    /** @var value-of<Direction> $direction */
    #[Required(enum: Direction::class)]
    public string $direction;

    #[Required('reason_code', nullable: true)]
    public ?string $reasonCode;

    #[Required(nullable: true)]
    public ?string $reason;

    #[Required('occurred_at')]
    public \DateTimeInterface $occurredAt;

    /**
     * `new Event()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Event::with(
     *   level: ...,
     *   canonicalStatus: ...,
     *   nativeCode: ...,
     *   source: ...,
     *   direction: ...,
     *   reasonCode: ...,
     *   reason: ...,
     *   occurredAt: ...,
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Event)
     *   ->withLevel(...)
     *   ->withCanonicalStatus(...)
     *   ->withNativeCode(...)
     *   ->withSource(...)
     *   ->withDirection(...)
     *   ->withReasonCode(...)
     *   ->withReason(...)
     *   ->withOccurredAt(...)
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
     * @param Level|value-of<Level> $level
     * @param CanonicalStatus|value-of<CanonicalStatus>|null $canonicalStatus
     * @param Source|value-of<Source> $source
     * @param Direction|value-of<Direction> $direction
     */
    public static function with(
        Level|string $level,
        CanonicalStatus|string|null $canonicalStatus,
        ?string $nativeCode,
        Source|string $source,
        Direction|string $direction,
        ?string $reasonCode,
        ?string $reason,
        \DateTimeInterface $occurredAt,
    ): self {
        $self = new self;

        $self['level'] = $level;
        $self['canonicalStatus'] = $canonicalStatus;
        $self['nativeCode'] = $nativeCode;
        $self['source'] = $source;
        $self['direction'] = $direction;
        $self['reasonCode'] = $reasonCode;
        $self['reason'] = $reason;
        $self['occurredAt'] = $occurredAt;

        return $self;
    }

    /**
     * @param Level|value-of<Level> $level
     */
    public function withLevel(Level|string $level): self
    {
        $self = clone $this;
        $self['level'] = $level;

        return $self;
    }

    /**
     * @param CanonicalStatus|value-of<CanonicalStatus>|null $canonicalStatus
     */
    public function withCanonicalStatus(
        CanonicalStatus|string|null $canonicalStatus
    ): self {
        $self = clone $this;
        $self['canonicalStatus'] = $canonicalStatus;

        return $self;
    }

    public function withNativeCode(?string $nativeCode): self
    {
        $self = clone $this;
        $self['nativeCode'] = $nativeCode;

        return $self;
    }

    /**
     * @param Source|value-of<Source> $source
     */
    public function withSource(Source|string $source): self
    {
        $self = clone $this;
        $self['source'] = $source;

        return $self;
    }

    /**
     * @param Direction|value-of<Direction> $direction
     */
    public function withDirection(Direction|string $direction): self
    {
        $self = clone $this;
        $self['direction'] = $direction;

        return $self;
    }

    public function withReasonCode(?string $reasonCode): self
    {
        $self = clone $this;
        $self['reasonCode'] = $reasonCode;

        return $self;
    }

    public function withReason(?string $reason): self
    {
        $self = clone $this;
        $self['reason'] = $reason;

        return $self;
    }

    public function withOccurredAt(\DateTimeInterface $occurredAt): self
    {
        $self = clone $this;
        $self['occurredAt'] = $occurredAt;

        return $self;
    }
}
