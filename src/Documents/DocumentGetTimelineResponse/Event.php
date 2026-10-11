<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetTimelineResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event\EventType;

/**
 * @phpstan-type EventShape = array{
 *   eventType: value-of<EventType>,
 *   timestamp: \DateTimeInterface,
 *   id?: string|null,
 *   details?: array<string,mixed>|null,
 * }
 */
final class Event implements BaseModel
{
    /** @use SdkModel<EventShape> */
    use SdkModel;

    /** @var value-of<EventType> $eventType */
    #[Required('event_type', enum: EventType::class)]
    public string $eventType;

    #[Required]
    public \DateTimeInterface $timestamp;

    #[Optional(nullable: true)]
    public ?string $id;

    /** @var array<string,mixed>|null $details */
    #[Optional(map: 'mixed', nullable: true)]
    public ?array $details;

    /**
     * `new Event()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Event::with(eventType: ..., timestamp: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Event)->withEventType(...)->withTimestamp(...)
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
     * @param EventType|value-of<EventType> $eventType
     * @param array<string,mixed>|null $details
     */
    public static function with(
        EventType|string $eventType,
        \DateTimeInterface $timestamp,
        ?string $id = null,
        ?array $details = null,
    ): self {
        $self = new self;

        $self['eventType'] = $eventType;
        $self['timestamp'] = $timestamp;

        null !== $id && $self['id'] = $id;
        null !== $details && $self['details'] = $details;

        return $self;
    }

    /**
     * @param EventType|value-of<EventType> $eventType
     */
    public function withEventType(EventType|string $eventType): self
    {
        $self = clone $this;
        $self['eventType'] = $eventType;

        return $self;
    }

    public function withTimestamp(\DateTimeInterface $timestamp): self
    {
        $self = clone $this;
        $self['timestamp'] = $timestamp;

        return $self;
    }

    public function withID(?string $id): self
    {
        $self = clone $this;
        $self['id'] = $id;

        return $self;
    }

    /**
     * @param array<string,mixed>|null $details
     */
    public function withDetails(?array $details): self
    {
        $self = clone $this;
        $self['details'] = $details;

        return $self;
    }
}
