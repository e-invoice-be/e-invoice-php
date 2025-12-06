<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\DocumentType;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant\Entity;

/**
 * Represents the result of a Peppol directory search.
 *
 * @phpstan-type LookupGetParticipantsResponseShape = array{
 *   query_terms: string,
 *   search_date: string,
 *   total_count: int,
 *   used_count: int,
 *   participants?: list<Participant>|null,
 * }
 */
final class LookupGetParticipantsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<LookupGetParticipantsResponseShape> */
    use SdkModel;

    use SdkResponse;

    /**
     * Query terms used for search.
     */
    #[Api]
    public string $query_terms;

    /**
     * Search date of the result.
     */
    #[Api]
    public string $search_date;

    /**
     * Total number of results.
     */
    #[Api]
    public int $total_count;

    /**
     * Number of results returned by the API.
     */
    #[Api]
    public int $used_count;

    /**
     * List of participants.
     *
     * @var list<Participant>|null $participants
     */
    #[Api(list: Participant::class, optional: true)]
    public ?array $participants;

    /**
     * `new LookupGetParticipantsResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * LookupGetParticipantsResponse::with(
     *   query_terms: ..., search_date: ..., total_count: ..., used_count: ...
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
     *   peppol_id: string,
     *   peppol_scheme: string,
     *   document_types?: list<DocumentType>|null,
     *   entities?: list<Entity>|null,
     * }> $participants
     */
    public static function with(
        string $query_terms,
        string $search_date,
        int $total_count,
        int $used_count,
        ?array $participants = null,
    ): self {
        $obj = new self;

        $obj['query_terms'] = $query_terms;
        $obj['search_date'] = $search_date;
        $obj['total_count'] = $total_count;
        $obj['used_count'] = $used_count;

        null !== $participants && $obj['participants'] = $participants;

        return $obj;
    }

    /**
     * Query terms used for search.
     */
    public function withQueryTerms(string $queryTerms): self
    {
        $obj = clone $this;
        $obj['query_terms'] = $queryTerms;

        return $obj;
    }

    /**
     * Search date of the result.
     */
    public function withSearchDate(string $searchDate): self
    {
        $obj = clone $this;
        $obj['search_date'] = $searchDate;

        return $obj;
    }

    /**
     * Total number of results.
     */
    public function withTotalCount(int $totalCount): self
    {
        $obj = clone $this;
        $obj['total_count'] = $totalCount;

        return $obj;
    }

    /**
     * Number of results returned by the API.
     */
    public function withUsedCount(int $usedCount): self
    {
        $obj = clone $this;
        $obj['used_count'] = $usedCount;

        return $obj;
    }

    /**
     * List of participants.
     *
     * @param list<Participant|array{
     *   peppol_id: string,
     *   peppol_scheme: string,
     *   document_types?: list<DocumentType>|null,
     *   entities?: list<Entity>|null,
     * }> $participants
     */
    public function withParticipants(array $participants): self
    {
        $obj = clone $this;
        $obj['participants'] = $participants;

        return $obj;
    }
}
