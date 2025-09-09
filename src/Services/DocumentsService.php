<?php

declare(strict_types=1);

namespace EInvoiceAPI\Services;

use EInvoiceAPI\Client;
use EInvoiceAPI\Documents\CurrencyCode;
use EInvoiceAPI\Documents\DocumentAttachmentCreate;
use EInvoiceAPI\Documents\DocumentCreateParams;
use EInvoiceAPI\Documents\DocumentCreateParams\Item;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail;
use EInvoiceAPI\Documents\DocumentDeleteResponse;
use EInvoiceAPI\Documents\DocumentDirection;
use EInvoiceAPI\Documents\DocumentResponse;
use EInvoiceAPI\Documents\DocumentSendParams;
use EInvoiceAPI\Documents\DocumentType;
use EInvoiceAPI\Documents\PaymentDetailCreate;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\ServiceContracts\DocumentsContract;
use EInvoiceAPI\Services\Documents\AttachmentsService;
use EInvoiceAPI\Services\Documents\UblService;

use const EInvoiceAPI\Core\OMIT as omit;

final class DocumentsService implements DocumentsContract
{
    /**
     * @@api
     */
    public AttachmentsService $attachments;

    /**
     * @@api
     */
    public UblService $ubl;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->attachments = new AttachmentsService($this->client);
        $this->ubl = new UblService($this->client);
    }

    /**
     * @api
     *
     * Create a new invoice or credit note
     *
     * @param float|string|null $amountDue
     * @param list<DocumentAttachmentCreate>|null $attachments
     * @param string|null $billingAddress
     * @param string|null $billingAddressRecipient
     * @param CurrencyCode|value-of<CurrencyCode> $currency Currency of the invoice
     * @param string|null $customerAddress
     * @param string|null $customerAddressRecipient
     * @param string|null $customerEmail
     * @param string|null $customerID
     * @param string|null $customerName
     * @param string|null $customerTaxID
     * @param DocumentDirection|value-of<DocumentDirection> $direction
     * @param DocumentType|value-of<DocumentType> $documentType
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
     * @param DocumentState|value-of<DocumentState> $state
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
    public function create(
        $amountDue = omit,
        $attachments = omit,
        $billingAddress = omit,
        $billingAddressRecipient = omit,
        $currency = omit,
        $customerAddress = omit,
        $customerAddressRecipient = omit,
        $customerEmail = omit,
        $customerID = omit,
        $customerName = omit,
        $customerTaxID = omit,
        $direction = omit,
        $documentType = omit,
        $dueDate = omit,
        $invoiceDate = omit,
        $invoiceID = omit,
        $invoiceTotal = omit,
        $items = omit,
        $note = omit,
        $paymentDetails = omit,
        $paymentTerm = omit,
        $previousUnpaidBalance = omit,
        $purchaseOrder = omit,
        $remittanceAddress = omit,
        $remittanceAddressRecipient = omit,
        $serviceAddress = omit,
        $serviceAddressRecipient = omit,
        $serviceEndDate = omit,
        $serviceStartDate = omit,
        $shippingAddress = omit,
        $shippingAddressRecipient = omit,
        $state = omit,
        $subtotal = omit,
        $taxDetails = omit,
        $totalDiscount = omit,
        $totalTax = omit,
        $vendorAddress = omit,
        $vendorAddressRecipient = omit,
        $vendorEmail = omit,
        $vendorName = omit,
        $vendorTaxID = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = DocumentCreateParams::parseRequest(
            [
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
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
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
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        // @phpstan-ignore-next-line;
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
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse {
        // @phpstan-ignore-next-line;
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
     * Send an invoice or credit note via Peppol
     *
     * @param string|null $email
     * @param string|null $receiverPeppolID
     * @param string|null $receiverPeppolScheme
     * @param string|null $senderPeppolID
     * @param string|null $senderPeppolScheme
     */
    public function send(
        string $documentID,
        $email = omit,
        $receiverPeppolID = omit,
        $receiverPeppolScheme = omit,
        $senderPeppolID = omit,
        $senderPeppolScheme = omit,
        ?RequestOptions $requestOptions = null,
    ): DocumentResponse {
        [$parsed, $options] = DocumentSendParams::parseRequest(
            [
                'email' => $email,
                'receiverPeppolID' => $receiverPeppolID,
                'receiverPeppolScheme' => $receiverPeppolScheme,
                'senderPeppolID' => $senderPeppolID,
                'senderPeppolScheme' => $senderPeppolScheme,
            ],
            $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
            convert: DocumentResponse::class,
        );
    }
}
