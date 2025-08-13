<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\ListOf;
use EInvoiceAPI\Responses\Lookup\LookupGetParticipantsResponse\Participant;

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
     * @param null|list<Participant> $participants
     */
    public static function from(
        string $queryTerms,
        string $searchDate,
        int $totalCount,
        int $usedCount,
        ?array $participants = null,
    ): self {
        $obj = new self;

        $obj->queryTerms = $queryTerms;
        $obj->searchDate = $searchDate;
        $obj->totalCount = $totalCount;
        $obj->usedCount = $usedCount;

        null !== $participants && $obj->participants = $participants;

        return $obj;
    }

    /**
     * Query terms used for search.
     */
    public function setQueryTerms(string $queryTerms): self
    {
        $this->queryTerms = $queryTerms;

        return $this;
    }

    /**
     * Search date of the result.
     */
    public function setSearchDate(string $searchDate): self
    {
        $this->searchDate = $searchDate;

        return $this;
    }

    /**
     * Total number of results.
     */
    public function setTotalCount(int $totalCount): self
    {
        $this->totalCount = $totalCount;

        return $this;
    }

    /**
     * Number of results returned by the API.
     */
    public function setUsedCount(int $usedCount): self
    {
        $this->usedCount = $usedCount;

        return $this;
    }

    /**
     * List of participants.
     *
     * @param list<Participant> $participants
     */
    public function setParticipants(array $participants): self
    {
        $this->participants = $participants;

        return $this;
    }
}
