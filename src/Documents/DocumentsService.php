<?php

declare(strict_types=1);

namespace EInvoiceAPI\Documents;

use EInvoiceAPI\Client;
use EInvoiceAPI\Contracts\DocumentsContract;
use EInvoiceAPI\Core\Conversion;
use EInvoiceAPI\Documents\Attachments\AttachmentsService;
use EInvoiceAPI\Documents\DocumentCreateParams\Item;
use EInvoiceAPI\Documents\DocumentCreateParams\TaxDetail;
use EInvoiceAPI\Documents\Ubl\UblService;
use EInvoiceAPI\Inbox\DocumentState;
use EInvoiceAPI\RequestOptions;
use EInvoiceAPI\Responses\Documents\DocumentDeleteResponse;

final class DocumentsService implements DocumentsContract
{
    public AttachmentsService $attachments;

    public UblService $ubl;

    public function __construct(private Client $client)
    {
        $this->attachments = new AttachmentsService($this->client);
        $this->ubl = new UblService($this->client);
    }

    /**
     * Create a new invoice or credit note.
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
    public function create(
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
        $resp = $this->client->request(
            method: 'post',
            path: 'api/documents/',
            body: (object) $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * Get an invoice or credit note by ID.
     */
    public function retrieve(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentResponse {
        $resp = $this->client->request(
            method: 'get',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }

    /**
     * Delete an invoice or credit note.
     */
    public function delete(
        string $documentID,
        ?RequestOptions $requestOptions = null
    ): DocumentDeleteResponse {
        $resp = $this->client->request(
            method: 'delete',
            path: ['api/documents/%1$s', $documentID],
            options: $requestOptions,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentDeleteResponse::class, value: $resp);
    }

    /**
     * Send an invoice or credit note via Peppol.
     *
     * @param null|string $email
     * @param null|string $receiverPeppolID
     * @param null|string $receiverPeppolScheme
     * @param null|string $senderPeppolID
     * @param null|string $senderPeppolScheme
     */
    public function send(
        string $documentID,
        $email = null,
        $receiverPeppolID = null,
        $receiverPeppolScheme = null,
        $senderPeppolID = null,
        $senderPeppolScheme = null,
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
        $resp = $this->client->request(
            method: 'post',
            path: ['api/documents/%1$s/send', $documentID],
            query: $parsed,
            options: $options,
        );

        // @phpstan-ignore-next-line;
        return Conversion::coerce(DocumentResponse::class, value: $resp);
    }
}
