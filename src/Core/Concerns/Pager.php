<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Concerns;

use Psr\Http\Message\ResponseInterface;
use EInvoiceAPI\Core\BaseClient;
use EInvoiceAPI\Core\Pagination\PageRequestOptions;

/**
 * @internal
 */
interface Pager
{
    public function __construct(
        BaseClient $client,
        PageRequestOptions $options,
        ResponseInterface $response,
        mixed $body,
    );
}
