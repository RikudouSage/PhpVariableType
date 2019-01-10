<?php

namespace rikudou\VariableType;

final class Types
{
    public const BOOL = "boolean";
    public const INT = "integer";
    public const FLOAT = "float";
    public const STRING = "string";
    public const ARRAY = "array";
    public const OBJECT = "object";
    public const CALLABLE = "callable";
    public const ITERABLE = "iterable";
    public const RESOURCE = "resource";
    public const NULL = "NULL";

    // aliases
    public const BOOLEAN = self::BOOL;
    public const INTEGER = self::INT;
}