<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Core\Contracts\BaseResponse;
use EInvoiceAPI\Core\Exceptions\APIException;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateFromPdfParams;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentCreateParams\Allowance;
use EInvoiceAPI\Documents\DocumentCreateParams\Charge;
use EInvoiceAPI\Documents\DocumentCreateParams\Item;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxCode;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail;
use EInvoiceAPI\Documents\DocumentCreateParams\Vatex;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentNewFromPdfResponse;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentSendParams;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsRawContract;
use EInvoiceAPI\Validate\UblDocumentValidation;

/**
 * @phpstan-import-type AllowanceShape from \EInvoiceAPI\Documents\DocumentCreateParams\Allowance
 * @phpstan-import-type AmountDueShape from \EInvoiceAPI\Documents\DocumentCreateParams\AmountDue
 * @phpstan-import-type DocumentAttachmentCreateShape from \EInvoiceAPI\Documents\DocumentAttachmentCreate
 * @phpstan-import-type ChargeShape from \EInvoiceAPI\Documents\DocumentCreateParams\Charge
 * @phpstan-import-type InvoiceTotalShape from \EInvoiceAPI\Documents\DocumentCreateParams\InvoiceTotal
 * @phpstan-import-type ItemShape from \EInvoiceAPI\Documents\DocumentCreateParams\Item
 * @phpstan-import-type PaymentDetailCreateShape from \EInvoiceAPI\Documents\PaymentDetailCreate
 * @phpstan-import-type PreviousUnpaidBalanceShape from \EInvoiceAPI\Documents\DocumentCreateParams\PreviousUnpaidBalance
 * @phpstan-import-type SubtotalShape from \EInvoiceAPI\Documents\DocumentCreateParams\Subtotal
 * @phpstan-import-type TaxDetailShape from \EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail
 * @phpstan-import-type TotalDiscountShape from \EInvoiceAPI\Documents\DocumentCreateParams\TotalDiscount
 * @phpstan-import-type TotalTaxShape from \EInvoiceAPI\Documents\DocumentCreateParams\TotalTax
 * @phpstan-import-type RequestOpts from \EInvoiceAPI\RequestOptions
 */
final class DocumentsRawService implements DocumentsRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Create a new invoice or credit note
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
     *   customerTaxID?: string|null,
     *   direction?: DocumentDirection|value-of<DocumentDirection>,
     *   documentType?: DocumentType|value-of<DocumentType>,
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
     * }|DocumentCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function create(
        array|DocumentCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DocumentCreateParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Get an invoice or credit note by ID
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function retrieve(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Delete an invoice or credit note
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentDeleteResponse>
     *
     * @throws APIException
     */
    public function delete(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
            convert: DocumentDeleteResponse::class,
        );
    }

    /**
     * @api
     *
     * Create a new invoice or credit note from a PDF file. If the 'ubl_document' field is set in the response, it indicates that sufficient details were extracted from the PDF to automatically generate a valid UBL document ready for sending. If 'ubl_document' is not set, human intervention may be required to ensure compliance.
     *
     * @param array{
     *   file: string, customerTaxID?: string|null, vendorTaxID?: string|null
     * }|DocumentCreateFromPdfParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentNewFromPdfResponse>
     *
     * @throws APIException
     */
    public function createFromPdf(
        array|DocumentCreateFromPdfParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DocumentCreateFromPdfParams::parseRequest(
            $params,
            $requestOptions,
        );
        $query_params = array_flip(['customerTaxID', 'vendorTaxID']);

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'api/documents/pdf',
            query: Util::array_transform_keys(
                array_intersect_key($parsed, $query_params),
                [
                    'customerTaxID' => 'customer_tax_id', 'vendorTaxID' => 'vendor_tax_id',
                ],
            ),
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) array_diff_key($parsed, $query_params),
            options: $options,
            convert: DocumentNewFromPdfResponse::class,
        );
    }

    /**
     * @api
     *
     * Send an invoice or credit note via Peppol
     *
     * @param array{
     *   email?: string|null,
     *   receiverPeppolID?: string|null,
     *   receiverPeppolScheme?: string|null,
     *   senderPeppolID?: string|null,
     *   senderPeppolScheme?: string|null,
     * }|DocumentSendParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<DocumentResponse>
     *
     * @throws APIException
     */
    public function send(
        string $documentID,
        array|DocumentSendParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = DocumentSendParams::parseRequest(
            $params,
            $requestOptions,
        );

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: Util::array_transform_keys(
                $parsed,
                [
                    'receiverPeppolID' => 'receiver_peppol_id',
                    'receiverPeppolScheme' => 'receiver_peppol_scheme',
                    'senderPeppolID' => 'sender_peppol_id',
                    'senderPeppolScheme' => 'sender_peppol_scheme',
                ],
            ),
            options: $options,
            convert: DocumentResponse::class,
        );
    }

    /**
     * @api
     *
     * Validate a UBL document according to Peppol BIS Billing 3.0
     *
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<UblDocumentValidation>
     *
     * @throws APIException
     */
    public function validate(
        string $documentID,
        RequestOptions|array|null $requestOptions = null
    ): BaseResponse {
        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/validate', $documentID],
            options: $requestOptions,
            convert: UblDocumentValidation::class,
        );
    }
}
