<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup\LookupGetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity\Identifier;

/**
 * Represents a Peppol participant with their details.
 *
 * @phpstan-type ParticipantShape = array{
 *   peppol_id: string,
 *   peppol_scheme: string,
 *   document_types?: list<DocumentType>|null,
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
    #[Api]
    public string $peppol_id;

    /**
     * Peppol scheme of the participant.
     */
    #[Api]
    public string $peppol_scheme;

    /**
     * List of supported document types.
     *
     * @var list<DocumentType>|null $document_types
     */
    #[Api(list: DocumentType::class, optional: true)]
    public ?array $document_types;

    /**
     * List of business entities.
     *
     * @var list<Entity>|null $entities
     */
    #[Api(list: Entity::class, optional: true)]
    public ?array $entities;

    /**
     * `new Participant()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * Participant::with(peppol_id: ..., peppol_scheme: ...)
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
     * @param list<DocumentType|array{scheme: string, value: string}> $document_types
     * @param list<Entity|array{
     *   additional_info?: string|null,
     *   country_code?: string|null,
     *   geo_info?: string|null,
     *   identifiers?: list<Identifier>|null,
     *   name?: string|null,
     *   registration_date?: string|null,
     *   website?: string|null,
     * }> $entities
     */
    public static function with(
        string $peppol_id,
        string $peppol_scheme,
        ?array $document_types = null,
        ?array $entities = null,
    ): self {
        $obj = new self;

        $obj['peppol_id'] = $peppol_id;
        $obj['peppol_scheme'] = $peppol_scheme;

        null !== $document_types && $obj['document_types'] = $document_types;
        null !== $entities && $obj['entities'] = $entities;

        return $obj;
    }

    /**
     * Peppol ID of the participant.
     */
    public function withPeppolID(string $peppolID): self
    {
        $obj = clone $this;
        $obj['peppol_id'] = $peppolID;

        return $obj;
    }

    /**
     * Peppol scheme of the participant.
     */
    public function withPeppolScheme(string $peppolScheme): self
    {
        $obj = clone $this;
        $obj['peppol_scheme'] = $peppolScheme;

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
        $obj['document_types'] = $documentTypes;

        return $obj;
    }

    /**
     * List of business entities.
     *
     * @param list<Entity|array{
     *   additional_info?: string|null,
     *   country_code?: string|null,
     *   geo_info?: string|null,
     *   identifiers?: list<Identifier>|null,
     *   name?: string|null,
     *   registration_date?: string|null,
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
