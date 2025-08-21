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
     * @param float|string|null $amountDue
     * @param list<DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress
     * @param string|null $billingAddressRecipient
     * @param CurrencyCode::* $currency Currency of the invoice
     * @param string|null $customerAddress
     * @param string|null $customerAddressRecipient
     * @param string|null $customerEmail
     * @param string|null $customerID
     * @param string|null $customerName
     * @param string|null $customerTaxID
     * @param DocumentDirection::* $direction
     * @param DocumentType::* $documentType
     * @param \DateTimeInterface|null $dueDate
     * @param \DateTimeInterface|null $invoiceDate
     * @param string|null $invoiceID
     * @param float|string|null $invoiceTotal
     * @param list<Item>|null $items
     * @param string|null $note
     * @param list<PaymentDetailCreate>|null $paymentDetails
     * @param string|null $paymentTerm
     * @param float|string|null $previousUnpaidBalance
     * @param string|null $purchaseOrder
     * @param string|null $remittanceAddress
     * @param string|null $remittanceAddressRecipient
     * @param string|null $serviceAddress
     * @param string|null $serviceAddressRecipient
     * @param \DateTimeInterface|null $serviceEndDate
     * @param \DateTimeInterface|null $serviceStartDate
     * @param string|null $shippingAddress
     * @param string|null $shippingAddressRecipient
     * @param DocumentState::* $state
     * @param float|string|null $subtotal
     * @param list<TaxDetail>|null $taxDetails
     * @param float|string|null $totalDiscount
     * @param float|string|null $totalTax
     * @param string|null $vendorAddress
     * @param string|null $vendorAddressRecipient
     * @param string|null $vendorEmail
     * @param string|null $vendorName
     * @param string|null $vendorTaxID
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
