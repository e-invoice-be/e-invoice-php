<?php

declare(strict_types=1);

namespace EInvoiceAPI\Models;

use EInvoiceAPI\Core\None;
use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Concerns\Model;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde\UnionOf;
use EInvoiceAPI\Core\Serde\MapOf;

class Certificate implements BaseModel
{
    use Model;

    #[Api]
    public string $status;

    /**
     * @var array<string, mixed>|null $details
     */
    #[Api(type: new UnionOf([new MapOf('mixed'), 'null']), optional: true)]
    public ?array $details;

    #[Api(optional: true)]
    public ?string $error;

    /**
     * @param array<string, mixed>|null $details
     * @param string|null               $error
     */
    final public function __construct(
        string $status,
        array|None|null $details = None::NOT_SET,
        string|None|null $error = None::NOT_SET,
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
