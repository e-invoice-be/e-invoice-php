<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\FileParam;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\ValidateRawContract;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Charge;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxCode;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Vatex;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDResponse;
use EInvoiceAPI\Validate\ValidateValidateUblParams;

/**
 * @phpstan-import-type AllowanceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Allowance
 * @phpstan-import-type AmountDueShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\AmountDue
 * @phpstan-import-type DocumentAttachmentCreateShape from \EInvoiceAPI\Documents\DocumentAttachmentCreate
 * @phpstan-import-type ChargeShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Charge
 * @phpstan-import-type InvoiceTotalShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\InvoiceTotal
 * @phpstan-import-type ItemShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Item
 * @phpstan-import-type PaymentDetailCreateShape from \EInvoiceAPI\Documents\PaymentDetailCreate
 * @phpstan-import-type PreviousUnpaidBalanceShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\PreviousUnpaidBalance
 * @phpstan-import-type SubtotalShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\Subtotal
 * @phpstan-import-type TaxDetailShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail
 * @phpstan-import-type TotalDiscountShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TotalDiscount
 * @phpstan-import-type TotalTaxShape from \EInvoiceAPI\Validate\ValidateValidateJsonParams\TotalTax
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class ValidateRawService implements ValidateRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Validate if the JSON document can be converted to a valid UBL document
     *
     * @param array{
     *   allowances?: list<Allowance|AllowanceShape>|null,
     *   amountDue?: AmountDueShape|null,
     *   attachments?: list<DocumentAttachmentCreate|DocumentAttachmentCreateShape>|null,
     *   billingAddress?: string|null,
     *   billingAddressRecipient?: string|null,
     *   charges?: list<Charge|ChargeShape>|null,
     *   currency?: value-of<CurrencyCode>,
     *   customerAddress?: string|null,
     *   customerAddressRecipient?: string|null,
     *   customerCompanyID?: string|null,
     *   customerEmail?: string|null,
     *   customerID?: string|null,
     *   customerName?: string|null,
     *   customerPeppolID?: string|null,
     *   customerTaxID?: string|null,
     *   direction?: DocumentDirection|value-of<DocumentDirection>,
     *   documentType?: value-of<DocumentType>,
     *   dueDate?: string|null,
     *   invoiceDate?: string|null,
     *   invoiceID?: string|null,
     *   invoiceTotal?: InvoiceTotalShape|null,
     *   items?: list<Item|ItemShape>,
     *   note?: string|null,
     *   paymentDetails?: list<PaymentDetailCreate|PaymentDetailCreateShape>|null,
     *   paymentTerm?: string|null,
     *   previousUnpaidBalance?: PreviousUnpaidBalanceShape|null,
     *   purchaseOrder?: string|null,
     *   remittanceAddress?: string|null,
     *   remittanceAddressRecipient?: string|null,
     *   serviceAddress?: string|null,
     *   serviceAddressRecipient?: string|null,
     *   serviceEndDate?: string|null,
     *   serviceStartDate?: string|null,
     *   shippingAddress?: string|null,
     *   shippingAddressRecipient?: string|null,
     *   state?: DocumentState|value-of<DocumentState>,
     *   subtotal?: SubtotalShape|null,
     *   taxCode?: TaxCode|value-of<TaxCode>,
     *   taxDetails?: list<TaxDetail|TaxDetailShape>|null,
     *   totalDiscount?: TotalDiscountShape|null,
     *   totalTax?: TotalTaxShape|null,
     *   vatex?: value-of<Vatex>,
     *   vatexNote?: string|null,
     *   vendorAddress?: string|null,
     *   vendorAddressRecipient?: string|null,
     *   vendorCompanyID?: string|null,
     *   vendorEmail?: string|null,
     *   vendorName?: string|null,
     *   vendorTaxID?: string|null,
     * }|ValidateValidateJsonParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateJson(
        array|ValidateValidateJsonParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ValidateValidateJsonParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/validate/json',
            body: (object) $parsed,
            options: $options,
            convert: UblDocumentValidation::class,
        );
    }

    /**
     * @api
     *
     * Validate if a Peppol ID exists in the Peppol network and retrieve supported document types. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param array{peppolID: string}|ValidateValidatePeppolIDParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<ValidateValidatePeppolIDResponse>
     *
     * @throws APIException
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ValidateValidatePeppolIDParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: 'api/validate/peppol-id',
            query: Util::array_transform_keys($parsed, ['peppolID' => 'peppol_id']),
            options: $options,
            convert: ValidateValidatePeppolIDResponse::class,
        );
    }

    /**
     * @api
     *
     * Validate the correctness of a UBL document
     *
     * @param array{file: string|FileParam}|ValidateValidateUblParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validateUbl(
        array|ValidateValidateUblParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = ValidateValidateUblParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/validate/ubl',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
            convert: UblDocumentValidation::class,
        );
    }
}
