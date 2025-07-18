<?php

declare(strict_types=1);

namespace EInvoiceAPI\Responses;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Responses\LookupGetParticipantsResponse\Participant;

final class LookupGetParticipantsResponse implements BaseModel
{
    use Model;

    #[Api('query_terms')]
    public string $queryTerms;

    #[Api('search_date')]
    public string $searchDate;

    #[Api('total_count')]
    public int $totalCount;

    #[Api('used_count')]
    public int $usedCount;

    /** @var null|list<Participant> $participants */
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
        $this->queryTerms = $queryTerms;
        $this->searchDate = $searchDate;
        $this->totalCount = $totalCount;
        $this->usedCount = $usedCount;

        self::_introspect();
        $this->unsetOptionalProperties();

        null !== $participants && $this->participants = $participants;
    }
}
