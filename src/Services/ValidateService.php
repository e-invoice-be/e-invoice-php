<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\ValidateContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Core\Util;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Validate\ValidateValidatePeppolIDResponse;
use EInvoiceAPI\Validate\UblDocumentValidation;
use EInvoiceAPI\Validate\ValidateValidateJsonParams;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\Item;
use EInvoiceAPI\Validate\ValidateValidateJsonParams\TaxDetail;
use EInvoiceAPI\Validate\ValidateValidatePeppolIDParams;
use EInvoiceAPI\Validate\ValidateValidateUblParams;

final class ValidateService implements ValidateContract
{
    public function __construct(private Client $client) {}

    /**
     * Validate if the JSON document can be converted to a valid UBL document.
     *
     * @param null|float|string $amountDue
     * @param null|list<DocumentAttachmentCreate> $attachments
     * @param null|string $billingAddress
     * @param null|string $billingAddressRecipient
     * @param CurrencyCode::* $currency Currency of the invoice
     * @param null|string $customerAddress
     * @param null|string $customerAddressRecipient
     * @param null|string $customerEmail
     * @param null|string $customerID
     * @param null|string $customerName
     * @param null|string $customerTaxID
     * @param DocumentDirection::* $direction
     * @param DocumentType::* $documentType
     * @param null|\DateTimeInterface $dueDate
     * @param null|\DateTimeInterface $invoiceDate
     * @param null|string $invoiceID
     * @param null|float|string $invoiceTotal
     * @param null|list<Item> $items
     * @param null|string $note
     * @param null|list<PaymentDetailCreate> $paymentDetails
     * @param null|string $paymentTerm
     * @param null|float|string $previousUnpaidBalance
     * @param null|string $purchaseOrder
     * @param null|string $remittanceAddress
     * @param null|string $remittanceAddressRecipient
     * @param null|string $serviceAddress
     * @param null|string $serviceAddressRecipient
     * @param null|\DateTimeInterface $serviceEndDate
     * @param null|\DateTimeInterface $serviceStartDate
     * @param null|string $shippingAddress
     * @param null|string $shippingAddressRecipient
     * @param DocumentState::* $state
     * @param null|float|string $subtotal
     * @param null|list<TaxDetail> $taxDetails
     * @param null|float|string $totalDiscount
     * @param null|float|string $totalTax
     * @param null|string $vendorAddress
     * @param null|string $vendorAddressRecipient
     * @param null|string $vendorEmail
     * @param null|string $vendorName
     * @param null|string $vendorTaxID
     */
    public function validateJson(
        $amountDue = null,
        $attachments = null,
        $billingAddress = null,
        $billingAddressRecipient = null,
        $currency = null,
        $customerAddress = null,
        $customerAddressRecipient = null,
        $customerEmail = null,
        $customerID = null,
        $customerName = null,
        $customerTaxID = null,
        $direction = null,
        $documentType = null,
        $dueDate = null,
        $invoiceDate = null,
        $invoiceID = null,
        $invoiceTotal = null,
        $items = null,
        $note = null,
        $paymentDetails = null,
        $paymentTerm = null,
        $previousUnpaidBalance = null,
        $purchaseOrder = null,
        $remittanceAddress = null,
        $remittanceAddressRecipient = null,
        $serviceAddress = null,
        $serviceAddressRecipient = null,
        $serviceEndDate = null,
        $serviceStartDate = null,
        $shippingAddress = null,
        $shippingAddressRecipient = null,
        $state = null,
        $subtotal = null,
        $taxDetails = null,
        $totalDiscount = null,
        $totalTax = null,
        $vendorAddress = null,
        $vendorAddressRecipient = null,
        $vendorEmail = null,
        $vendorName = null,
        $vendorTaxID = null,
        ?RequestOptions $requestOptions = null,
    ): UblDocumentValidation {
        $args = [
            'amountDue' => $amountDue,
            'attachments' => $attachments,
            'billingAddress' => $billingAddress,
            'billingAddressRecipient' => $billingAddressRecipient,
            'currency' => $currency,
            'customerAddress' => $customerAddress,
            'customerAddressRecipient' => $customerAddressRecipient,
            'customerEmail' => $customerEmail,
            'customerID' => $customerID,
            'customerName' => $customerName,
            'customerTaxID' => $customerTaxID,
            'direction' => $direction,
            'documentType' => $documentType,
            'dueDate' => $dueDate,
            'invoiceDate' => $invoiceDate,
            'invoiceID' => $invoiceID,
            'invoiceTotal' => $invoiceTotal,
            'items' => $items,
            'note' => $note,
            'paymentDetails' => $paymentDetails,
            'paymentTerm' => $paymentTerm,
            'previousUnpaidBalance' => $previousUnpaidBalance,
            'purchaseOrder' => $purchaseOrder,
            'remittanceAddress' => $remittanceAddress,
            'remittanceAddressRecipient' => $remittanceAddressRecipient,
            'serviceAddress' => $serviceAddress,
            'serviceAddressRecipient' => $serviceAddressRecipient,
            'serviceEndDate' => $serviceEndDate,
            'serviceStartDate' => $serviceStartDate,
            'shippingAddress' => $shippingAddress,
            'shippingAddressRecipient' => $shippingAddressRecipient,
            'state' => $state,
            'subtotal' => $subtotal,
            'taxDetails' => $taxDetails,
            'totalDiscount' => $totalDiscount,
            'totalTax' => $totalTax,
            'vendorAddress' => $vendorAddress,
            'vendorAddressRecipient' => $vendorAddressRecipient,
            'vendorEmail' => $vendorEmail,
            'vendorName' => $vendorName,
            'vendorTaxID' => $vendorTaxID,
        ];
        $args = Util::array_filter_null(
            $args,
            [
                'amountDue',
                'attachments',
                'billingAddress',
                'billingAddressRecipient',
                'currency',
                'customerAddress',
                'customerAddressRecipient',
                'customerEmail',
                'customerID',
                'customerName',
                'customerTaxID',
                'direction',
                'documentType',
                'dueDate',
                'invoiceDate',
                'invoiceID',
                'invoiceTotal',
                'items',
                'note',
                'paymentDetails',
                'paymentTerm',
                'previousUnpaidBalance',
                'purchaseOrder',
                'remittanceAddress',
                'remittanceAddressRecipient',
                'serviceAddress',
                'serviceAddressRecipient',
                'serviceEndDate',
                'serviceStartDate',
                'shippingAddress',
                'shippingAddressRecipient',
                'state',
                'subtotal',
                'taxDetails',
                'totalDiscount',
                'totalTax',
                'vendorAddress',
                'vendorAddressRecipient',
                'vendorEmail',
                'vendorName',
                'vendorTaxID',
            ],
        );
        [$parsed, $options] = ValidateValidateJsonParams::parseRequest(
            $args,
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
     * @param string $peppolID Peppol ID in the format `<scheme>:<id>`. Example: `0208:1018265814` for a Belgian company.
     */
    public function validatePeppolID(
        $peppolID,
        ?RequestOptions $requestOptions = null
    ): ValidateValidatePeppolIDResponse {
        $args = ['peppolID' => $peppolID];
        [$parsed, $options] = ValidateValidatePeppolIDParams::parseRequest(
            $args,
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
     * @param string $file
     */
    public function validateUbl(
        $file,
        ?RequestOptions $requestOptions = null
    ): UblDocumentValidation {
        $args = ['file' => $file];
        [$parsed, $options] = ValidateValidateUblParams::parseRequest(
            $args,
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
