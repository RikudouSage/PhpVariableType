[![Build Status](https://img.shields.io/travis/com/RikudouSage/PhpVariableType/master.svg)](https://travis-ci.com/RikudouSage/PhpVariableType)
[![Coverage Status](https://img.shields.io/coveralls/github/RikudouSage/PhpVariableType/master.svg)](https://coveralls.io/github/RikudouSage/PhpVariableType?branch=master)

## Installation

`composer require rikudou/variable-type`

## Usage

```php
<?php

use rikudou\VariableType\VariableType;

$int = 1;

$type = new VariableType($int);
$type->isScalar(); // true
$type->isBoolean(); // false
$type->isInteger(); // true
$type->isFloat(); // true
$type->isString(); // true
$type->isStringable(); // false
$type->isArray(); // false
$type->isObject(); // false
$type->isCallable(); // false
$type->isIterable(); // false
$type->isResource(); // false
$type->isNull(); // false
$type->getType(); // "integer"
strval($type); // "integer"

$float = 1.1;
$type = new VariableType($float);
$type->isScalar(); // true
$type->isFloat(); // true
$type->getType(); // "float"

$string = "str_repeat";
$type = new VariableType($string);
$type->isScalar(); // true
$type->isString(); // true
$type->isStringable(); // true
$type->isCallable(); // true
$type->getType(); // "string"

$object = new stdClass();
$type = new VariableType($object);
$type->getType(); // "object (stdClass)"

$resource = fopen("php://memory", "r");
$type = new VariableType($resource);
$type->getType(); // "resource (stream)"

$fn = function() {
    return true;
};
$type = new VariableType($fn);
$type->getType(); // "anonymous function"
```