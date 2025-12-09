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
        $obj = new self;

        $obj['peppolID'] = $peppolID;
        $obj['peppolScheme'] = $peppolScheme;

        null !== $documentTypes && $obj['documentTypes'] = $documentTypes;
        null !== $entities && $obj['entities'] = $entities;

        return $obj;
    }

    /**
     * Peppol ID of the participant.
     */
    public function withPeppolID(string $peppolID): self
    {
        $obj = clone $this;
        $obj['peppolID'] = $peppolID;

        return $obj;
    }

    /**
     * Peppol scheme of the participant.
     */
    public function withPeppolScheme(string $peppolScheme): self
    {
        $obj = clone $this;
        $obj['peppolScheme'] = $peppolScheme;

        return $obj;
    }

    /**
     * List of supported document types.
     *
     * @param list<DocumentType|array{scheme: string, value: string}> $documentTypes
     */
    public function withDocumentTypes(array $documentTypes): self
    {
        $obj = clone $this;
        $obj['documentTypes'] = $documentTypes;

        return $obj;
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
        $obj = clone $this;
        $obj['entities'] = $entities;

        return $obj;
    }
}
