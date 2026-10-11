<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event;
use EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event\EventType;

/**
 * @phpstan-type DocumentGetTimelineResponseShape = array{
 *   documentID: string, events: list<Event>
 * }
 */
final class DocumentGetTimelineResponse implements BaseModel
{
    /** @use SdkModel<DocumentGetTimelineResponseShape> */
    use SdkModel;

    #[Required('document_id')]
    public string $documentID;

    /** @var list<Event> $events */
    #[Required(list: Event::class)]
    public array $events;

    /**
     * `new DocumentGetTimelineResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentGetTimelineResponse::with(documentID: ..., events: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentGetTimelineResponse)->withDocumentID(...)->withEvents(...)
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
     * @param list<Event|array{
     *   eventType: value-of<EventType>,
     *   timestamp: \DateTimeInterface,
     *   id?: string|null,
     *   details?: array<string,mixed>|null,
     * }> $events
     */
    public static function with(string $documentID, array $events): self
    {
        $self = new self;

        $self['documentID'] = $documentID;
        $self['events'] = $events;

        return $self;
    }

    public function withDocumentID(string $documentID): self
    {
        $self = clone $this;
        $self['documentID'] = $documentID;

        return $self;
    }

    /**
     * @param list<Event|array{
     *   eventType: value-of<EventType>,
     *   timestamp: \DateTimeInterface,
     *   id?: string|null,
     *   details?: array<string,mixed>|null,
     * }> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }
}
