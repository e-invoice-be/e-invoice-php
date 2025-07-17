<?php

declare(strict_types=1);

namespace EInvoiceAPI\Resources;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\ValidateContract;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Models\CurrencyCode;
use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\DocumentDirection;
use EInvoiceAPI\Models\DocumentState;
use EInvoiceAPI\Models\DocumentType;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Models\UblDocumentValidation;
use EInvoiceAPI\Models\ValidatePeppolIDResponse;
use EInvoiceAPI\Parameters\Validate\ValidateJsonParams;
use EInvoiceAPI\Parameters\Validate\ValidateJsonParams\Item;
use EInvoiceAPI\Parameters\Validate\ValidateJsonParams\TaxDetail;
use EInvoiceAPI\Parameters\Validate\ValidatePeppolIDParams;
use EInvoiceAPI\Parameters\Validate\ValidateUblParams;
use EInvoiceAPI\RequestOptions;

final class Validate implements ValidateContract
{
    public function __construct(private Client $client) {}

    /**
     * @param ValidateJsonParams|array{
     *   amountDue?: float|string|null,
     *   attachments?: list<DocumentAttachmentCreate>|null,
     *   billingAddress?: string|null,
     *   billingAddressRecipient?: string|null,
     *   currency?: CurrencyCode::*,
     *   customerAddress?: string|null,
     *   customerAddressRecipient?: string|null,
     *   customerEmail?: string|null,
     *   customerID?: string|null,
     *   customerName?: string|null,
     *   customerTaxID?: string|null,
     *   direction?: DocumentDirection::*,
     *   documentType?: DocumentType::*,
     *   dueDate?: \DateTimeInterface|null,
     *   invoiceDate?: \DateTimeInterface|null,
     *   invoiceID?: string|null,
     *   invoiceTotal?: float|string|null,
     *   items?: list<Item>|null,
     *   note?: string|null,
     *   paymentDetails?: list<PaymentDetailCreate>|null,
     *   paymentTerm?: string|null,
     *   previousUnpaidBalance?: float|string|null,
     *   purchaseOrder?: string|null,
     *   remittanceAddress?: string|null,
     *   remittanceAddressRecipient?: string|null,
     *   serviceAddress?: string|null,
     *   serviceAddressRecipient?: string|null,
     *   serviceEndDate?: \DateTimeInterface|null,
     *   serviceStartDate?: \DateTimeInterface|null,
     *   shippingAddress?: string|null,
     *   shippingAddressRecipient?: string|null,
     *   state?: DocumentState::*,
     *   subtotal?: float|string|null,
     *   taxDetails?: list<TaxDetail>|null,
     *   totalDiscount?: float|string|null,
     *   totalTax?: float|string|null,
     *   vendorAddress?: string|null,
     *   vendorAddressRecipient?: string|null,
     *   vendorEmail?: string|null,
     *   vendorName?: string|null,
     *   vendorTaxID?: string|null,
     * } $params
     */
    public function validateJson(
        array|ValidateJsonParams $params,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation {
        [$parsed, $options] = ValidateJsonParams::parseRequest(
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
        return Serde::coerce(UblDocumentValidation::class, value: $resp);
    }

    /**
     * @param array{peppolID?: string}|ValidatePeppolIDParams $params
     */
    public function validatePeppolID(
        array|ValidatePeppolIDParams $params,
        ?RequestOptions $requestOptions = null
    ): ValidatePeppolIDResponse {
        [$parsed, $options] = ValidatePeppolIDParams::parseRequest(
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
        return Serde::coerce(ValidatePeppolIDResponse::class, value: $resp);
    }

    /**
     * @param array{file?: string}|ValidateUblParams $params
     */
    public function validateUbl(
        array|ValidateUblParams $params,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation {
        [$parsed, $options] = ValidateUblParams::parseRequest(
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
        return Serde::coerce(UblDocumentValidation::class, value: $resp);
    }
}
