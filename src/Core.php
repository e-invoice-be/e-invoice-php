<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core;

/**
 * @internal
 */
enum Omittable
{
    case OMIT;
}

const OMIT = Omittable::OMIT;
