<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant\Entity;

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
    use SdkModel;

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

    /**
     * `new Participant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Participant::with(peppolID: ..., peppolScheme: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new Participant)->withPeppolID(...)->withPeppolScheme(...)
     * ```
     */
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
    public static function with(
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
    public function withPeppolID(string $peppolID): self
    {
        $obj = clone $this;
        $obj->peppolID = $peppolID;

        return $obj;
    }

    /**
     * Peppol scheme of the participant.
     */
    public function withPeppolScheme(string $peppolScheme): self
    {
        $obj = clone $this;
        $obj->peppolScheme = $peppolScheme;

        return $obj;
    }

    /**
     * List of supported document types.
     *
     * @param list<DocumentType> $documentTypes
     */
    public function withDocumentTypes(array $documentTypes): self
    {
        $obj = clone $this;
        $obj->documentTypes = $documentTypes;

        return $obj;
    }

    /**
     * List of business entities.
     *
     * @param list<Entity> $entities
     */
    public function withEntities(array $entities): self
    {
        $obj = clone $this;
        $obj->entities = $entities;

        return $obj;
    }
}
