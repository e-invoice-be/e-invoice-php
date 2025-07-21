<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\LookupGetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant\Entity;

/**
 * @phpstan-type participant_alias = array{
 *   peppolID: string,
 *   peppolScheme: string,
 *   documentTypes?: list<DocumentType>,
 *   entities?: list<Entity>,
 * }
 */
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
        self::introspect();
        $this->unsetOptionalProperties();

        $this->peppolID = $peppolID;
        $this->peppolScheme = $peppolScheme;

        null !== $documentTypes && $this->documentTypes = $documentTypes;
        null !== $entities && $this->entities = $entities;
    }
}
