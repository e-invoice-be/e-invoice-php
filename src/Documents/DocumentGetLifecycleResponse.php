<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\CanonicalStatus;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Direction;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Level;
use EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event\Source;

/**
 * @phpstan-type DocumentGetLifecycleResponseShape = array{
 *   documentID: string, events: list<Event>
 * }
 */
final class DocumentGetLifecycleResponse implements BaseModel
{
    /** @use SdkModel<DocumentGetLifecycleResponseShape> */
    use SdkModel;

    #[Required('document_id')]
    public string $documentID;

    /** @var list<Event> $events */
    #[Required(list: Event::class)]
    public array $events;

    /**
     * `new DocumentGetLifecycleResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * DocumentGetLifecycleResponse::with(documentID: ..., events: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new DocumentGetLifecycleResponse)->withDocumentID(...)->withEvents(...)
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
     *   level: value-of<Level>,
     *   canonicalStatus: value-of<CanonicalStatus>|null,
     *   nativeCode: string|null,
     *   source: value-of<Source>,
     *   direction: value-of<Direction>,
     *   reasonCode: string|null,
     *   reason: string|null,
     *   occurredAt: \DateTimeInterface,
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
     *   level: value-of<Level>,
     *   canonicalStatus: value-of<CanonicalStatus>|null,
     *   nativeCode: string|null,
     *   source: value-of<Source>,
     *   direction: value-of<Direction>,
     *   reasonCode: string|null,
     *   reason: string|null,
     *   occurredAt: \DateTimeInterface,
     * }> $events
     */
    public function withEvents(array $events): self
    {
        $self = clone $this;
        $self['events'] = $events;

        return $self;
    }
}
