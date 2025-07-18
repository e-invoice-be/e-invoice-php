<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Contracts;

/**
 * @internal
 */
interface BasePage extends \Stringable
{
    /**
     * @return \Traversable<mixed>
     */
    public function pagingEachItem(): \Traversable;
}
