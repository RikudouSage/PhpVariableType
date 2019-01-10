<?php

namespace rikudou\VariableType;

class VariableType
{

    /**
     * @var mixed
     */
    private $variable;

    /**
     * @param mixed $variable The variable to check
     */
    public function __construct($variable)
    {
        $this->variable = $variable;
    }

    public function isScalar(): bool
    {
        return is_scalar($this->variable);
    }

    public function isBoolean(): bool
    {
        return is_bool($this->variable);
    }

    public function isInteger(): bool
    {
        return is_int($this->variable);
    }

    public function isFloat(): bool
    {
        return is_float($this->variable);
    }

    public function isString(): bool
    {
        return is_string($this->variable);
    }

    public function isStringable(): bool
    {
        if ($this->isString()) {
            return true;
        }
        return $this->isObject() && method_exists($this->variable, "__toString");
    }

    public function isArray(): bool
    {
        return is_array($this->variable);
    }

    public function isObject(): bool
    {
        return is_object($this->variable);
    }

    public function isCallable(): bool
    {
        return is_callable($this->variable);
    }

    public function isIterable(): bool
    {
        return is_iterable($this->variable);
    }

    public function isResource(): bool
    {
        return is_resource($this->variable);
    }

    public function isNull(): bool
    {
        return is_null($this->variable);
    }

    public function getType(): string
    {

        if ($this->isScalar() || $this->isArray() || $this->isNull()) {
            return $this->getBultinType();
        }
        if ($this->isResource()) {

            return "resource (" . get_resource_type($this->variable) . ")";
        }
        if ($this->isObject()) {
            if ($this->variable instanceof \Closure) {
                return "anonymous function";
            }
            return "object ({$this->getClass()})";
        }
        throw new \LogicException("Unknown type: {$this->getBultinType()}");
    }

    private function getClass(): string
    {
        if (!$this->isObject()) {
            throw new \LogicException("Cannot get class of non-object, '{$this->getBultinType()}' given");
        }
        return get_class($this->variable);
    }

    private function getBultinType(): string
    {
        $type = gettype($this->variable);
        if ($type === "double") {
            $type = "float";
        }
        return $type;
    }

    public function __toString()
    {
        try {
            return $this->getType();
        } catch (\Throwable $exception) {
            return "";
        }
    }

}