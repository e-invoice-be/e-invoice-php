<?php

declare(strict_types=1);

namespace EInvoiceAPI\Me\MeGetResponse;

/**
 * Plan of the tenant.
 */
enum Plan: string
{
    case STARTER = 'starter';

    case PRO = 'pro';

    case ENTERPRISE = 'enterprise';
}
