<?php

declare(strict_types=1);

namespace EInvoiceAPI\Core\Concerns;

use EInvoiceAPI\Core\Attributes\Api;
use EInvoiceAPI\Core\Contracts\BaseModel;
use EInvoiceAPI\Core\Serde;
use EInvoiceAPI\Core\Serde\CoerceState;
use EInvoiceAPI\Core\Serde\DumpState;
use EInvoiceAPI\Core\Serde\PropertyInfo;
use EInvoiceAPI\Core\Util;

trait Model
{
    /**
     * @var \ReflectionClass<BaseModel>
     */
    private static \ReflectionClass $_class;

    /**
     * @var array<string, PropertyInfo>
     */
    private static array $_properties = [];

    /**
     * @var list<string>
     */
    private static array $_constructorArgNames = [];

    /**
     * @var array<string, mixed> keeps track of undocumented data
     */
    private array $_data = [];

    private static bool $_metadataLoaded = false;

    /**
     * @return array<string, mixed>
     */
    public function __serialize(): array
    {
        return [...Util::get_object_vars($this), ...$this->_data];
    }

    /**
     * @param array<mixed> $data
     */
    public function __unserialize(array $data): void
    {
        foreach ($data as $key => $value) {
            $this->offsetSet($key, $value);
        }
    }

    /**
     * @return array<string, mixed>
     */
    public function __debugInfo(): array
    {
        return $this->__serialize();
    }

    public function __toString(): string
    {
        return json_encode($this->__debugInfo(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?: '';
    }

    public function offsetExists(mixed $offset): bool
    {
        if (!is_string($offset)) { // @phpstan-ignore-line
            throw new \InvalidArgumentException();
        }

        if (array_key_exists($offset, array: $this->_data)) {
            return true;
        }

        if (property_exists($this, property: $offset)) {
            if (isset($this->{$offset})) {
                return true;
            }

            $property = self::$_properties[$offset]->property ?? new \ReflectionProperty($this, property: $offset);

            return $property->isInitialized($this);
        }

        return false;
    }

    public function &offsetGet(mixed $offset): mixed
    {
        if (!is_string($offset)) { // @phpstan-ignore-line
            throw new \InvalidArgumentException();
        }

        if (!$this->offsetExists($offset)) {
            return null;
        }

        if (array_key_exists($offset, array: $this->_data)) {
            return $this->_data[$offset];
        }

        return $this->{$offset};
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_string($offset)) { // @phpstan-ignore-line
            throw new \InvalidArgumentException();
        }

        $type = array_key_exists($offset, array: self::$_properties)
            ? self::$_properties[$offset]->type
            : 'mixed';

        $coerced = Serde::coerce($type, value: $value, state: new CoerceState(translateNames: false));

        if (property_exists($this, property: $offset)) {
            try {
                $this->{$offset} = $coerced;
                unset($this->_data[$offset]);

                return;
                // @phpstan-ignore-next-line
            } catch (\TypeError) {
                unset($this->{$offset});
            }
        }

        $this->_data[$offset] = $coerced;
    }

    public function offsetUnset(mixed $offset): void
    {
        if (!is_string($offset)) { // @phpstan-ignore-line
            throw new \InvalidArgumentException();
        }

        if (property_exists($this, property: $offset)) {
            unset($this->{$offset});
        }

        unset($this->_data[$offset]);
    }

    public static function coerce(mixed $value, CoerceState $state): mixed
    {
        if ($value instanceof self) {
            ++$state->yes;

            return $value;
        }

        if (!is_array($value) || array_is_list($value)) {
            ++$state->no;

            return $value;
        }

        ++$state->yes;

        $val = [...$value];
        $acc = [];

        foreach (self::$_properties as $name => $info) {
            $srcName = $state->translateNames ? $info->apiName : $name;
            if (!array_key_exists($srcName, array: $val)) {
                if ($info->optional) {
                    ++$state->yes;
                } elseif ($info->nullable) {
                    ++$state->maybe;
                } else {
                    ++$state->no;
                }

                continue;
            }

            $item = $val[$srcName];
            unset($val[$srcName]);

            if (is_null($item) && ($info->nullable || $info->optional)) {
                if ($info->nullable) {
                    ++$state->yes;
                } elseif ($info->optional) {
                    ++$state->maybe;
                }
                $acc[$name] = null;
            } else {
                $coerced = Serde::coerce($info->type, value: $item, state: $state);
                $acc[$name] = $coerced;
            }
        }

        foreach ($val as $name => $item) {
            $acc[$name] = $item;
        }

        // @phpstan-ignore-next-line
        return static::from($acc);
    }

    public static function dump(mixed $value, DumpState $state): mixed
    {
        if ($value instanceof self) {
            $value = $value->__serialize();
        }

        if (is_array($value)) {
            $acc = [];

            foreach ($value as $name => $item) {
                if (array_key_exists($name, array: self::$_properties)) {
                    $info = self::$_properties[$name];
                    $acc[$info->apiName] = Serde::dump($info->type, value: $item, state: $state);
                } else {
                    $acc[$name] = Serde::dump_unknown($item, state: $state);
                }
            }

            return $acc;
        }

        return Serde::dump_unknown($value, state: $state);
    }

    /**
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        // @phpstan-ignore-next-line
        return Serde::dump($this::class, value: $this->__serialize());
    }

    public static function from(mixed $data): self
    {
        self::_loadMetadata();

        /** @var self $instance */
        $instance = self::$_class->newInstanceWithoutConstructor();
        $instance->__unserialize($data); // @phpstan-ignore-line

        return $instance;
    }

    public static function _loadMetadata(): void
    {
        if (self::$_metadataLoaded) {
            return;
        }

        self::$_class = new \ReflectionClass(static::class);

        foreach (self::$_class->getConstructor()?->getParameters() ?? [] as $parameter) {
            self::$_constructorArgNames[] = $parameter->getName();
        }

        foreach (self::$_class->getProperties() as $property) {
            if (!empty($property->getAttributes(Api::class))) {
                $name = $property->getName();
                self::$_properties[$name] = new PropertyInfo($property);
            }
        }

        self::$_metadataLoaded = true;
    }
}
