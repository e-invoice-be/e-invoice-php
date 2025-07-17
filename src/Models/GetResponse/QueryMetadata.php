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
     * You must use named parameters to construct this object.
     */
    final public function __construct(
        string $identifierScheme,
        string $identifierValue,
        string $smlDomain,
        string $timestamp,
        string $version,
    ) {
        $this->identifierScheme = $identifierScheme;
        $this->identifierValue = $identifierValue;
        $this->smlDomain = $smlDomain;
        $this->timestamp = $timestamp;
        $this->version = $version;

        self::_introspect();
    }
}
