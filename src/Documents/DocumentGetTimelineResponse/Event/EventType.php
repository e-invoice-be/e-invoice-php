<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents\DocumentGetTimelineResponse\Event;

enum EventType: string
{
    case EMAIL_RECEIVED = 'email_received';

    case EMAIL_PROCESSED = 'email_processed';

    case DOCUMENT_CREATED = 'document_created';

    case SEND_ATTEMPTED = 'send_attempted';

    case SEND_FAILED = 'send_failed';

    case SEND_SUCCESS = 'send_success';

    case RECEIVE_SUCCESS = 'receive_success';

    case MLR_RECEIVED = 'mlr_received';

    case IMR_RECEIVED = 'imr_received';
}
