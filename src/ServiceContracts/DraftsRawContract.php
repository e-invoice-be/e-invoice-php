<?php

declare(strict_types=1);

namespace EInvoiceAPI\ServiceContracts;

use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\DocumentsNumberPage;
use EInvoiceAPI\Drafts\DraftListParams;
use EInvoiceAPI\RequestOptions;

/**
 * @phpstan-import-type DraftListParamsShape from DraftListParams
 */
interface DraftsRawContract
{
    /**
     * @api
     *
     * @param DraftListParamsShape|DraftListParams $params
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
