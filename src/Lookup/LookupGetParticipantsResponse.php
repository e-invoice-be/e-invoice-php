<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Optional;
use EInvoiceAPI\Core\Attributes\Required;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity;

/**
 * Represents the result of a Peppol directory search.
 *
 * @phpstan-type LookupGetParticipantsResponseShape = array{
 *   queryTerms: string,
 *   searchDate: string,
 *   totalCount: int,
 *   usedCount: int,
 *   participants?: list<Participant>|null,
 * }
 */
final class LookupGetParticipantsResponse implements BaseModel
{
    /** @use SdkModel<LookupGetParticipantsResponseShape> */
    use SdkModel;

    /**
     * Query terms used for search.
     */
    #[Required('query_terms')]
    public string $queryTerms;

    /**
     * Search date of the result.
     */
    #[Required('search_date')]
    public string $searchDate;

    /**
     * Total number of results.
     */
    #[Required('total_count')]
    public int $totalCount;

    /**
     * Number of results returned by the API.
     */
    #[Required('used_count')]
    public int $usedCount;

    /**
     * List of participants.
     *
     * @var list<Participant>|null $participants
     */
    #[Optional(list: Participant::class)]
    public ?array $participants;

    /**
     * `new LookupGetParticipantsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LookupGetParticipantsResponse::with(
     *   queryTerms: ..., searchDate: ..., totalCount: ..., usedCount: ...
     * )
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new LookupGetParticipantsResponse)
     *   ->withQueryTerms(...)
     *   ->withSearchDate(...)
     *   ->withTotalCount(...)
     *   ->withUsedCount(...)
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
     * @param list<Participant|array{
     *   peppolID: string,
     *   peppolScheme: string,
     *   documentTypes?: list<DocumentType>|null,
     *   entities?: list<Entity>|null,
     * }> $participants
     */
    public static function with(
        string $queryTerms,
        string $searchDate,
        int $totalCount,
        int $usedCount,
        ?array $participants = null,
    ): self {
        $self = new self;

        $self['queryTerms'] = $queryTerms;
        $self['searchDate'] = $searchDate;
        $self['totalCount'] = $totalCount;
        $self['usedCount'] = $usedCount;

        null !== $participants && $self['participants'] = $participants;

        return $self;
    }

    /**
     * Query terms used for search.
     */
    public function withQueryTerms(string $queryTerms): self
    {
        $self = clone $this;
        $self['queryTerms'] = $queryTerms;

        return $self;
    }

    /**
     * Search date of the result.
     */
    public function withSearchDate(string $searchDate): self
    {
        $self = clone $this;
        $self['searchDate'] = $searchDate;

        return $self;
    }

    /**
     * Total number of results.
     */
    public function withTotalCount(int $totalCount): self
    {
        $self = clone $this;
        $self['totalCount'] = $totalCount;

        return $self;
    }

    /**
     * Number of results returned by the API.
     */
    public function withUsedCount(int $usedCount): self
    {
        $self = clone $this;
        $self['usedCount'] = $usedCount;

        return $self;
    }

    /**
     * List of participants.
     *
     * @param list<Participant|array{
     *   peppolID: string,
     *   peppolScheme: string,
     *   documentTypes?: list<DocumentType>|null,
     *   entities?: list<Entity>|null,
     * }> $participants
     */
    public function withParticipants(array $participants): self
    {
        $self = clone $this;
        $self['participants'] = $participants;

        return $self;
    }
}
