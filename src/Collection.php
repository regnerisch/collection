<?php

declare(strict_types=1);

namespace Regnerisch\Collection;

class Collection implements \ArrayAccess, \Countable, \IteratorAggregate, \JsonSerializable, \Serializable
{
    private array $attributes = [];

    public static function fromArray(array $array): self
    {
        $self = new self();
        $self->attributes = $array;

        return $self;
    }

    public static function fromIterable(iterable $iterable): self
    {
        $self = new self();
        foreach ($iterable as $key => $value) {
            $self[$key] = $value;
        }

        return $self;
    }

    public function toArray(): array
    {
        return $this->attributes;
    }

    public function diff(self ...$collections)
    {
        $attributes = \array_diff($this->attributes, ...$collections);

        return self::fromArray($attributes);
    }

    public function add($value, $key = null)
    {
        if (!$key) {
            $this->attributes[] = $value;
        } else {
            $this->attributes[$key] = $value;
        }
    }

    public function get($key)
    {
        return $this->attributes[$key];
    }

    public function has($key): bool
    {
        return \array_key_exists($key, $this->attributes);
    }

    public function exists($value): bool
    {
        return \in_array($value, $this->attributes, true);
    }

    public function each($callable): self
    {
        $result = \array_map($callable, $this->attributes);

        return self::fromArray($result);
    }

    public function filter($callable): self
    {
        $result = \array_filter($this->attributes, $callable);

        return self::fromArray($result);
    }

    public function reverse($preserveKeys = null)
    {
        $attributes = \array_reverse($this->attributes, $preserveKeys);

        return self::fromArray($attributes);
    }

    public function sort($callback): self
    {
        $attributes = $this->attributes;
        \usort($attributes, $callback);

        return self::fromArray($attributes);
    }

    public function intersect(self ...$collections)
    {
        $attributes = \array_intersect($this->attributes, ...$collections);

        return self::fromArray($attributes);
    }

    public function shuffle(): self
    {
        $attributes = $this->attributes;
        \shuffle($attributes);

        return self::fromArray($attributes);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->attributes);
    }

    public function offsetExists($offset): bool
    {
        return \array_key_exists($offset, $this->attributes);
    }

    public function offsetGet($offset)
    {
        if (\array_key_exists($offset, $this->attributes)) {
            return $this->attributes[$offset];
        }

        return null;
    }

    public function offsetSet($offset, $value): void
    {
        $this->add($value, $offset);
    }

    public function offsetUnset($offset): void
    {
        unset($this->attributes[$offset]);
    }

    public function count(): int
    {
        return \count($this->attributes);
    }

    public function serialize(): string
    {
        return \serialize($this->attributes);
    }

    public function unserialize($serialized): void
    {
        $this->attributes = \unserialize($serialized, [
            'allowed_classes' => true,
        ]);
    }

    public function jsonSerialize(): array
    {
        return $this->attributes;
    }

    public function __set($name, $value): void
    {
        $this->attributes[$name] = $value;
    }

    public function __get($name)
    {
        return $this->attributes[$name];
    }

    public function __isset($name): bool
    {
        return \array_key_exists($name, $this->attributes);
    }
}
