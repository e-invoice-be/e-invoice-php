<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Drafts\DraftListParams;
use EInvoiceAPI\RequestOptions;

interface DraftsRawContract
{
    /**
     * @api
     *
     * @param array<mixed>|DraftListParams $params
     *
     * @return BaseResponse<DocumentsNumberPage<DocumentResponse>>
     *
     * @throws APIException
     */
    public function list(
        array|DraftListParams $params,
        ?RequestOptions $requestOptions = null,
    ): BaseResponse;
}
