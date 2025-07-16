<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetParticipantsResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Models\GetParticipantsResponse\Participant\Entity;

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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string                  $peppolID      `required`
     * @param string                  $peppolScheme  `required`
     * @param null|list<DocumentType> $documentTypes
     * @param null|list<Entity>       $entities
     */
    final public function __construct(
        $peppolID,
        $peppolScheme,
        $documentTypes = None::NOT_GIVEN,
        $entities = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

Participant::_loadMetadata();
