<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts;

use EInvoiceAPI\Models\DocumentAttachmentCreate;
use EInvoiceAPI\Models\PaymentDetailCreate;
use EInvoiceAPI\Models\UblDocumentValidation;
use EInvoiceAPI\Models\ValidatePeppolIDResponse;
use EInvoiceAPI\RequestOptions;

interface ValidateContract
{
    /**
     * @param array{
     *
     *       amountDue?: float|string|null,
     *       attachments?: list<DocumentAttachmentCreate>|null,
     *       billingAddress?: string|null,
     *       billingAddressRecipient?: string|null,
     *       currency?: string,
     *       customerAddress?: string|null,
     *       customerAddressRecipient?: string|null,
     *       customerEmail?: string|null,
     *       customerID?: string|null,
     *       customerName?: string|null,
     *       customerTaxID?: string|null,
     *       direction?: string,
     *       documentType?: string,
     *       dueDate?: \DateTimeInterface|null,
     *       invoiceDate?: \DateTimeInterface|null,
     *       invoiceID?: string|null,
     *       invoiceTotal?: float|string|null,
     *       items?: list<array{
     *
     *           amount?: float|string|null,
     *           date?: mixed|null,
     *           description?: string|null,
     *           productCode?: string|null,
     *           quantity?: float|string|null,
     *           tax?: float|string|null,
     *           taxRate?: string|null,
     *           unit?: string,
     *           unitPrice?: float|string|null,
     *
     * }>|null,
     *       note?: string|null,
     *       paymentDetails?: list<PaymentDetailCreate>|null,
     *       paymentTerm?: string|null,
     *       previousUnpaidBalance?: float|string|null,
     *       purchaseOrder?: string|null,
     *       remittanceAddress?: string|null,
     *       remittanceAddressRecipient?: string|null,
     *       serviceAddress?: string|null,
     *       serviceAddressRecipient?: string|null,
     *       serviceEndDate?: \DateTimeInterface|null,
     *       serviceStartDate?: \DateTimeInterface|null,
     *       shippingAddress?: string|null,
     *       shippingAddressRecipient?: string|null,
     *       state?: string,
     *       subtotal?: float|string|null,
     *       taxDetails?: list<array{
     *
     * amount?: float|string|null, rate?: string|null
     *
     * }>|null,
     *       totalDiscount?: float|string|null,
     *       totalTax?: float|string|null,
     *       vendorAddress?: string|null,
     *       vendorAddressRecipient?: string|null,
     *       vendorEmail?: string|null,
     *       vendorName?: string|null,
     *       vendorTaxID?: string|null,
     *
     * } $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function validateJson(
        array $params,
        mixed $requestOptions = []
    ): UblDocumentValidation;

    /**
     * @param array{peppolID?: string} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function validatePeppolID(
        array $params,
        mixed $requestOptions = []
    ): ValidatePeppolIDResponse;

    /**
     * @param array{file?: string} $params
     * @param RequestOptions|array{
     *
     *       timeout?: float|null,
     *       maxRetries?: int|null,
     *       initialRetryDelay?: float|null,
     *       maxRetryDelay?: float|null,
     *       extraHeaders?: list<string>|null,
     *       extraQueryParams?: list<string>|null,
     *       extraBodyParams?: list<string>|null,
     *
     * }|null $requestOptions
     */
    public function validateUbl(
        array $params,
        mixed $requestOptions = []
    ): UblDocumentValidation;
}
