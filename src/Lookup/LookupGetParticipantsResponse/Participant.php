<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity\Identifier;

/**
 * Represents a Peppol participant with their details.
 *
 * @phpstan-type ParticipantShape = array{
 *   peppolID: string,
 *   peppolScheme: string,
 *   documentTypes?: list<DocumentType>|null,
 *   entities?: list<Entity>|null,
 * }
 */
final class Participant implements BaseModel
{
    /** @use SdkModel<ParticipantShape> */
    use SdkModel;

    /**
     * Peppol ID of the participant.
     */
    #[Required('peppol_id')]
    public string $peppolID;

    /**
     * Peppol scheme of the participant.
     */
    #[Required('peppol_scheme')]
    public string $peppolScheme;

    /**
     * List of supported document types.
     *
     * @var list<DocumentType>|null $documentTypes
     */
    #[Optional('document_types', list: DocumentType::class)]
    public ?array $documentTypes;

    /**
     * List of business entities.
     *
     * @var list<Entity>|null $entities
     */
    #[Optional(list: Entity::class)]
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
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param list<DocumentType|array{scheme: string, value: string}> $documentTypes
     * @param list<Entity|array{
     *   additionalInfo?: string|null,
     *   countryCode?: string|null,
     *   geoInfo?: string|null,
     *   identifiers?: list<Identifier>|null,
     *   name?: string|null,
     *   registrationDate?: string|null,
     *   website?: string|null,
     * }> $entities
     */
    public static function with(
        string $peppolID,
        string $peppolScheme,
        ?array $documentTypes = null,
        ?array $entities = null,
    ): self {
        $self = new self;

        $self['peppolID'] = $peppolID;
        $self['peppolScheme'] = $peppolScheme;

        null !== $documentTypes && $self['documentTypes'] = $documentTypes;
        null !== $entities && $self['entities'] = $entities;

        return $self;
    }

    /**
     * Peppol ID of the participant.
     */
    public function withPeppolID(string $peppolID): self
    {
        $self = clone $this;
        $self['peppolID'] = $peppolID;

        return $self;
    }

    /**
     * Peppol scheme of the participant.
     */
    public function withPeppolScheme(string $peppolScheme): self
    {
        $self = clone $this;
        $self['peppolScheme'] = $peppolScheme;

        return $self;
    }

    /**
     * List of supported document types.
     *
     * @param list<DocumentType|array{scheme: string, value: string}> $documentTypes
     */
    public function withDocumentTypes(array $documentTypes): self
    {
        $self = clone $this;
        $self['documentTypes'] = $documentTypes;

        return $self;
    }

    /**
     * List of business entities.
     *
     * @param list<Entity|array{
     *   additionalInfo?: string|null,
     *   countryCode?: string|null,
     *   geoInfo?: string|null,
     *   identifiers?: list<Identifier>|null,
     *   name?: string|null,
     *   registrationDate?: string|null,
     *   website?: string|null,
     * }> $entities
     */
    public function withEntities(array $entities): self
    {
        $self = clone $this;
        $self['entities'] = $entities;

        return $self;
    }
}
