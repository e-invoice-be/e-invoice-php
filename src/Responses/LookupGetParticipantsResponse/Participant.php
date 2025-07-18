<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\Entity;

final class Participant implements BaseModel
{
    use Model;

    #[Api('peppol_id')]
    public string $peppolID;

    #[Api('peppol_scheme')]
    public string $peppolScheme;

    /** @var null|list<DocumentType> $documentTypes */
    #[Api(
        'document_types',
        type: new ListOf(DocumentType::class),
        optional: true
    )]
    public ?array $documentTypes;

    /** @var null|list<Entity> $entities */
    #[Api(type: new ListOf(Entity::class), optional: true)]
    public ?array $entities;

    /**
     * You must use named parameters to construct this object.
     *
     * @param null|list<DocumentType> $documentTypes
     * @param null|list<Entity>       $entities
     */
    final public function __construct(
        string $peppolID,
        string $peppolScheme,
        ?array $documentTypes = null,
        ?array $entities = null,
    ) {
        $this->peppolID = $peppolID;
        $this->peppolScheme = $peppolScheme;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $documentTypes && $this->documentTypes = $documentTypes;
        null !== $entities && $this->entities = $entities;
    }
}
