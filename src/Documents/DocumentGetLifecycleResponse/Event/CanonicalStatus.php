<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetLifecycleResponse\Event;

enum CanonicalStatus: string
{
    case DEPOSITED = 'deposited';

    case EMITTED = 'emitted';

    case DELIVERED = 'delivered';

    case REJECTED = 'rejected';

    case ACKNOWLEDGED = 'acknowledged';

    case APPROVED = 'approved';

    case PARTIALLY_APPROVED = 'partially_approved';

    case DISPUTED = 'disputed';

    case ON_HOLD = 'on_hold';

    case REFUSED = 'refused';

    case PAYMENT_SENT = 'payment_sent';

    case PAID = 'paid';
}
