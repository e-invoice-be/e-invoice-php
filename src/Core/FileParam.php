<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core;

use EInvoiceAPI\Core\Conversion\Contracts\Converter;
use EInvoiceAPI\Core\Conversion\Contracts\ConverterSource;
use EInvoiceAPI\Core\Conversion\FileOf;

/**
 * A file to upload in a `multipart/form-data` request, with its filename and content type.
 *
 * ```
 * FileParam::fromString($contents, filename: 'invoice.pdf', contentType: 'application/pdf')
 * FileParam::fromResource(fopen('invoice.pdf', 'r'), contentType: 'application/pdf')
 * ```
 */
final class FileParam implements ConverterSource
{
    public const DEFAULT_FILENAME = 'upload';

    public const DEFAULT_CONTENT_TYPE = 'application/octet-stream';

    /**
     * @param string|resource $data
     */
    private function __construct(
        public readonly mixed $data,
        public readonly string $filename,
        public readonly string $contentType,
    ) {}

    public static function fromString(
        string $contents,
        string $filename = self::DEFAULT_FILENAME,
        string $contentType = self::DEFAULT_CONTENT_TYPE,
    ): self {
        return new self($contents, filename: $filename, contentType: $contentType);
    }

    /**
     * The resource is read from its current position and is not closed.
     * The filename defaults to the base name of the path of the resource.
     *
     * @param resource $resource
     */
    public static function fromResource(
        mixed $resource,
        ?string $filename = null,
        string $contentType = self::DEFAULT_CONTENT_TYPE,
    ): self {
        if (!is_resource($resource)) {
            throw new \InvalidArgumentException('Expected a resource, got '.get_debug_type($resource));
        }

        if (is_null($filename)) {
            $uri = stream_get_meta_data($resource)['uri'] ?? '';
            $path = parse_url($uri, PHP_URL_PATH);
            $filename = basename(is_string($path) ? $path : '');
        }

        return new self($resource, filename: '' === $filename ? self::DEFAULT_FILENAME : $filename, contentType: $contentType);
    }

    /**
     * @internal
     */
    public static function converter(): Converter
    {
        return new FileOf;
    }
}
