<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models\GetResponse;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;

final class QueryMetadata implements BaseModel
{
    use Model;

    #[Api]
    public string $identifierScheme;

    #[Api]
    public string $identifierValue;

    #[Api]
    public string $smlDomain;

    #[Api]
    public string $timestamp;

    #[Api]
    public string $version;

    /**
     * You must use named parameters to construct this object. If an named argument is not
     * given, it will not be included during JSON serialization. The arguments are untyped
     * so you can pass any JSON serializable value, but the API expects the types to match
     * the PHPDoc types.
     *
     * @param string $identifierScheme `required`
     * @param string $identifierValue  `required`
     * @param string $smlDomain        `required`
     * @param string $timestamp        `required`
     * @param string $version          `required`
     */
    final public function __construct(
        $identifierScheme,
        $identifierValue,
        $smlDomain,
        $timestamp,
        $version
    ) {
        $this->constructFromArgs(func_get_args());
    }
}

QueryMetadata::_loadMetadata();
