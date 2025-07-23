<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant;

/**
 * Represents the result of a Peppol directory search.
 *
 * @phpstan-type lookup_get_participants_response_alias = array{
 *   queryTerms: string,
 *   searchDate: string,
 *   totalCount: int,
 *   usedCount: int,
 *   participants?: list<Participant>,
 * }
 */
final class LookupGetParticipantsResponse implements BaseModel
{
    use Model;

    /**
     * Query terms used for search.
     */
    #[Api('query_terms')]
    public string $queryTerms;

    /**
     * Search date of the result.
     */
    #[Api('search_date')]
    public string $searchDate;

    /**
     * Total number of results.
     */
    #[Api('total_count')]
    public int $totalCount;

    /**
     * Number of results returned by the API.
     */
    #[Api('used_count')]
    public int $usedCount;

    /**
     * List of participants.
     *
     * @var null|list<Participant> $participants
     */
    #[Api(type: new ListOf(Participant::class), optional: true)]
    public ?array $participants;

    /**
     * You must use named parameters to construct this object.
     *
     * @param null|list<Participant> $participants
     */
    final public function __construct(
        string $queryTerms,
        string $searchDate,
        int $totalCount,
        int $usedCount,
        ?array $participants = null,
    ) {
        self::introspect();
        $this->unsetOptionalProperties();

        $this->queryTerms = $queryTerms;
        $this->searchDate = $searchDate;
        $this->totalCount = $totalCount;
        $this->usedCount = $usedCount;

        null !== $participants && $this->participants = $participants;
    }
}
