<?php

declare(strict_types=1);

namespace EInvoiceAPI\Contracts\Documents;

use EInvoiceAPI\Models\Documents\DeleteResponse;
use EInvoiceAPI\Models\Documents\DocumentAttachment;
use EInvoiceAPI\RequestOptions;

interface AttachmentsContract
{
    /**
     * @param array{documentID?: string, attachmentID?: string} $params
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
    public function retrieve(
        string $attachmentID,
        array $params,
        mixed $requestOptions = []
    ): DocumentAttachment;

    /**
     * @param array{documentID?: string} $params
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
     *
     * @return list<DocumentAttachment>
     */
    public function list(
        string $documentID,
        array $params,
        mixed $requestOptions = []
    ): array;

    /**
     * @param array{documentID?: string, attachmentID?: string} $params
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
    public function delete(
        string $attachmentID,
        array $params,
        mixed $requestOptions = []
    ): DeleteResponse;

    /**
     * @param array{documentID?: string, file?: string} $params
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
    public function add(
        string $documentID,
        array $params,
        mixed $requestOptions = []
    ): DocumentAttachment;
}
