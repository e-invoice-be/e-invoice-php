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
 * Represents a Peppol participant with their details.
 *
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

    /**
     * Peppol ID of the participant.
     */
    #[Api('peppol_id')]
    public string $peppolID;

    /**
     * Peppol scheme of the participant.
     */
    #[Api('peppol_scheme')]
    public string $peppolScheme;

    /**
     * List of supported document types.
     *
     * @var null|list<DocumentType> $documentTypes
     */
    #[Api(
        'document_types',
        type: new ListOf(DocumentType::class),
        optional: true
    )]
    public ?array $documentTypes;

    /**
     * List of business entities.
     *
     * @var null|list<Entity> $entities
     */
    #[Api(type: new ListOf(Entity::class), optional: true)]
    public ?array $entities;

    public function __construct()
    {
        self::introspect();
        $this->unsetOptionalProperties();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param null|list<DocumentType> $documentTypes
     * @param null|list<Entity> $entities
     */
    public static function new(
        string $peppolID,
        string $peppolScheme,
        ?array $documentTypes = null,
        ?array $entities = null,
    ): self {
        $obj = new self;

        $obj->peppolID = $peppolID;
        $obj->peppolScheme = $peppolScheme;

        null !== $documentTypes && $obj->documentTypes = $documentTypes;
        null !== $entities && $obj->entities = $entities;

        return $obj;
    }

    /**
     * Peppol ID of the participant.
     */
    public function setPeppolID(string $peppolID): self
    {
        $this->peppolID = $peppolID;

        return $this;
    }

    /**
     * Peppol scheme of the participant.
     */
    public function setPeppolScheme(string $peppolScheme): self
    {
        $this->peppolScheme = $peppolScheme;

        return $this;
    }

    /**
     * List of supported document types.
     *
     * @param list<DocumentType> $documentTypes
     */
    public function setDocumentTypes(array $documentTypes): self
    {
        $this->documentTypes = $documentTypes;

        return $this;
    }

    /**
     * List of business entities.
     *
     * @param list<Entity> $entities
     */
    public function setEntities(array $entities): self
    {
        $this->entities = $entities;

        return $this;
    }
}
