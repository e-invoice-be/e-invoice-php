<?php

declare(strict_types=1);

namespace EInvoiceAPI\Lookup;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\SdkModel;
use EInvoiceAPI\Core\Concerns\SdkResponse;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Conversion\Contracts\ResponseConverter;
use EInvoiceAPI\Lookup\LookupGetParticipantsResponse\Participant;

/**
 * Represents the result of a Peppol directory search.
 *
 * @phpstan-type lookup_get_participants_response = array{
 *   queryTerms: string,
 *   searchDate: string,
 *   totalCount: int,
 *   usedCount: int,
 *   participants?: list<Participant>,
 * }
 */
final class LookupGetParticipantsResponse implements BaseModel, ResponseConverter
{
    /** @use SdkModel<lookup_get_participants_response> */
    use SdkModel;

    use SdkResponse;

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
     * @param list<Participant> $participants
     */
    public static function with(
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
    public function withQueryTerms(string $queryTerms): self
    {
        $obj = clone $this;
        $obj->queryTerms = $queryTerms;

        return $obj;
    }

    /**
     * Search date of the result.
     */
    public function withSearchDate(string $searchDate): self
    {
        $obj = clone $this;
        $obj->searchDate = $searchDate;

        return $obj;
    }

    /**
     * Total number of results.
     */
    public function withTotalCount(int $totalCount): self
    {
        $obj = clone $this;
        $obj->totalCount = $totalCount;

        return $obj;
    }

    /**
     * Number of results returned by the API.
     */
    public function withUsedCount(int $usedCount): self
    {
        $obj = clone $this;
        $obj->usedCount = $usedCount;

        return $obj;
    }

    /**
     * List of participants.
     *
     * @param list<Participant> $participants
     */
    public function withParticipants(array $participants): self
    {
        $obj = clone $this;
        $obj->participants = $participants;

        return $obj;
    }
}
