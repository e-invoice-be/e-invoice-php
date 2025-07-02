<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Serde\MapOf;
use EInvoiceAPI\Core\Serde\UnionOf;

class Certificate implements BaseModel
{
    use Model;

    #[Api]
    public string $status;

    /**
     * @var null|array<string, mixed> $details
     */
    #[Api(type: new UnionOf([new MapOf('mixed'), 'null']), optional: true)]
    public ?array $details;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * @param null|array<string, mixed> $details
     * @param null|string               $error
     */
    final public function __construct(
        string $status,
        null|array|None $details = None::NOT_SET,
        null|None|string $error = None::NOT_SET
    ) {
        $args = func_get_args();

        $data = [];
        for ($i = 0; $i < count($args); ++$i) {
            if (None::NOT_SET !== $args[$i]) {
                $data[self::$_constructorArgNames[$i]] = $args[$i] ?? null;
            }
        }

        $this->__unserialize($data);
    }
}

Certificate::_loadMetadata();
