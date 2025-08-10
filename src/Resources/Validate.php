<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\ValidateContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Models\CurrencyCode;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentDirection;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Models\UblDocumentValidation;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam\Item;
use EInvoiceAPI\Parameters\ValidateValidateJsonParam\TaxDetail;
use EInvoiceAPI\Parameters\ValidateValidatePeppolIDParam;
use EInvoiceAPI\Parameters\ValidateValidateUblParam;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\ValidateValidatePeppolIDResponse;

final class Validate implements ValidateContract
{
    public function __construct(private Client $client) {}

    /**
     * Validate if the JSON document can be converted to a valid UBL document.
     *
     * @param array{
     *   amountDue?: null|float|string,
     *   attachments?: null|list<DocumentAttachmentCreate>,
     *   billingAddress?: null|string,
     *   billingAddressRecipient?: null|string,
     *   currency?: CurrencyCode::*,
     *   customerAddress?: null|string,
     *   customerAddressRecipient?: null|string,
     *   customerEmail?: null|string,
     *   customerID?: null|string,
     *   customerName?: null|string,
     *   customerTaxID?: null|string,
     *   direction?: DocumentDirection::*,
     *   documentType?: DocumentType::*,
     *   dueDate?: null|\DateTimeInterface,
     *   invoiceDate?: null|\DateTimeInterface,
     *   invoiceID?: null|string,
     *   invoiceTotal?: null|float|string,
     *   items?: null|list<Item>,
     *   note?: null|string,
     *   paymentDetails?: null|list<PaymentDetailCreate>,
     *   paymentTerm?: null|string,
     *   previousUnpaidBalance?: null|float|string,
     *   purchaseOrder?: null|string,
     *   remittanceAddress?: null|string,
     *   remittanceAddressRecipient?: null|string,
     *   serviceAddress?: null|string,
     *   serviceAddressRecipient?: null|string,
     *   serviceEndDate?: null|\DateTimeInterface,
     *   serviceStartDate?: null|\DateTimeInterface,
     *   shippingAddress?: null|string,
     *   shippingAddressRecipient?: null|string,
     *   state?: DocumentState::*,
     *   subtotal?: null|float|string,
     *   taxDetails?: null|list<TaxDetail>,
     *   totalDiscount?: null|float|string,
     *   totalTax?: null|float|string,
     *   vendorAddress?: null|string,
     *   vendorAddressRecipient?: null|string,
     *   vendorEmail?: null|string,
     *   vendorName?: null|string,
     *   vendorTaxID?: null|string,
     * }|ValidateValidateJsonParam $params
     */
    public function validateJson(
        array|ValidateValidateJsonParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation {
        [$parsed, $options] = ValidateValidateJsonParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'api/validate/json',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(UblDocumentValidation::class, value: $resp);
    }

    /**
     * Validate if a Peppol ID exists in the Peppol network and retrieve supported document types. The peppol_id must be in the form of `<scheme>:<id>`. The scheme is a 4-digit code representing the identifier scheme, and the id is the actual identifier value. For example, for a Belgian company it is `0208:0123456789` (where 0208 is the scheme for Belgian enterprises, followed by the 10 digits of the official BTW / KBO number).
     *
     * @param array{peppolID: string}|ValidateValidatePeppolIDParam $params
     */
    public function validatePeppolID(
        array|ValidateValidatePeppolIDParam $params,
        ?RequestOptions $requestOptions = null,
    ): ValidateValidatePeppolIDResponse {
        [$parsed, $options] = ValidateValidatePeppolIDParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'get',
            path: 'api/validate/peppol-id',
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(
            ValidateValidatePeppolIDResponse::class,
            value: $resp
        );
    }

    /**
     * Validate the correctness of a UBL document.
     *
     * @param array{file: string}|ValidateValidateUblParam $params
     */
    public function validateUbl(
        array|ValidateValidateUblParam $params,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation {
        [$parsed, $options] = ValidateValidateUblParam::parseRequest(
            $params,
            $requestOptions
        );
        $resp = $this->client->request(
            method: 'post',
            path: 'api/validate/ubl',
            headers: ['Content-Type' => 'multipart/form-data'],
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(UblDocumentValidation::class, value: $resp);
    }
}
