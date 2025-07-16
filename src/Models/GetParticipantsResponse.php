<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\ListOf;
use EInvoiceAPI\Models\GetParticipantsResponse\Participant;

final class GetParticipantsResponse implements BaseModel
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
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string                 $queryTerms   `required`
     * @param string                 $searchDate   `required`
     * @param int                    $totalCount   `required`
     * @param int                    $usedCount    `required`
     * @param null|list<Participant> $participants
     */
    final public function __construct(
        $queryTerms,
        $searchDate,
        $totalCount,
        $usedCount,
        $participants = None::NOT_GIVEN,
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

GetParticipantsResponse::_loadMetadata();
