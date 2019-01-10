<?php

namespace rikudou\VariableType\Tests;

use PHPUnit\Framework\TestCase;
use rikudou\VariableType\Tests\Resources\ClassWithStaticMethod;
use rikudou\VariableType\Tests\Resources\InvokableClass;
use rikudou\VariableType\Tests\Resources\IterableClass;
use rikudou\VariableType\Tests\Resources\StringableClass;
use rikudou\VariableType\VariableType;

class VariableTypeTest extends TestCase
{

    private $data = [
        "integer" => 1,
        "float" => 1.1,
        "string" => "hello",
        "array" => [],
        "callable" => [ClassWithStaticMethod::class, "callableMethod"],
        "invalidCallable" => [ClassWithStaticMethod::class, "uncallableMethod"],
        "null" => null,
        "boolean" => true,
        // these are set in constructor
        "iterable" => null,
        "closure" => null,
        "resource" => null,
        "object" => null,
        "invokable" => null,
        "stringable" => null,
    ];

    public function __construct(?string $name = null, array $data = [], string $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->data["iterable"] = new IterableClass();
        $this->data["closure"] = function () {
            return null;
        };
        $this->data["resource"] = fopen("php://memory", "r");
        $this->data["object"] = new \stdClass();
        $this->data["invokable"] = new InvokableClass();
        $this->data["stringable"] = new StringableClass();
    }

    public function testIsInteger()
    {
        $this->assertTrue($this->getInstance("integer")->isInteger());
        $this->assertFalse($this->getInstance("float")->isInteger());
        $this->assertFalse($this->getInstance("string")->isInteger());
        $this->assertFalse($this->getInstance("array")->isInteger());
        $this->assertFalse($this->getInstance("callable")->isInteger());
        $this->assertFalse($this->getInstance("invalidCallable")->isInteger());
        $this->assertFalse($this->getInstance("null")->isInteger());
        $this->assertFalse($this->getInstance("boolean")->isInteger());
        $this->assertFalse($this->getInstance("iterable")->isInteger());
        $this->assertFalse($this->getInstance("closure")->isInteger());
        $this->assertFalse($this->getInstance("resource")->isInteger());
        $this->assertFalse($this->getInstance("object")->isInteger());
        $this->assertFalse($this->getInstance("invokable")->isInteger());
        $this->assertFalse($this->getInstance("stringable")->isInteger());
    }

    public function testIsArray()
    {
        $this->assertFalse($this->getInstance("integer")->isArray());
        $this->assertFalse($this->getInstance("float")->isArray());
        $this->assertFalse($this->getInstance("string")->isArray());
        $this->assertTrue($this->getInstance("array")->isArray());
        $this->assertTrue($this->getInstance("callable")->isArray());
        $this->assertTrue($this->getInstance("invalidCallable")->isArray());
        $this->assertFalse($this->getInstance("null")->isArray());
        $this->assertFalse($this->getInstance("boolean")->isArray());
        $this->assertFalse($this->getInstance("iterable")->isArray());
        $this->assertFalse($this->getInstance("closure")->isArray());
        $this->assertFalse($this->getInstance("resource")->isArray());
        $this->assertFalse($this->getInstance("object")->isArray());
        $this->assertFalse($this->getInstance("invokable")->isArray());
        $this->assertFalse($this->getInstance("stringable")->isArray());
    }

    public function testIsNull()
    {
        $this->assertFalse($this->getInstance("integer")->isNull());
        $this->assertFalse($this->getInstance("float")->isNull());
        $this->assertFalse($this->getInstance("string")->isNull());
        $this->assertFalse($this->getInstance("array")->isNull());
        $this->assertFalse($this->getInstance("callable")->isNull());
        $this->assertFalse($this->getInstance("invalidCallable")->isNull());
        $this->assertTrue($this->getInstance("null")->isNull());
        $this->assertFalse($this->getInstance("boolean")->isNull());
        $this->assertFalse($this->getInstance("iterable")->isNull());
        $this->assertFalse($this->getInstance("closure")->isNull());
        $this->assertFalse($this->getInstance("resource")->isNull());
        $this->assertFalse($this->getInstance("object")->isNull());
        $this->assertFalse($this->getInstance("invokable")->isNull());
        $this->assertFalse($this->getInstance("stringable")->isNull());
    }

    public function testIsBoolean()
    {
        $this->assertFalse($this->getInstance("integer")->isBoolean());
        $this->assertFalse($this->getInstance("float")->isBoolean());
        $this->assertFalse($this->getInstance("string")->isBoolean());
        $this->assertFalse($this->getInstance("array")->isBoolean());
        $this->assertFalse($this->getInstance("callable")->isBoolean());
        $this->assertFalse($this->getInstance("invalidCallable")->isBoolean());
        $this->assertFalse($this->getInstance("null")->isBoolean());
        $this->assertTrue($this->getInstance("boolean")->isBoolean());
        $this->assertFalse($this->getInstance("iterable")->isBoolean());
        $this->assertFalse($this->getInstance("closure")->isBoolean());
        $this->assertFalse($this->getInstance("resource")->isBoolean());
        $this->assertFalse($this->getInstance("object")->isBoolean());
        $this->assertFalse($this->getInstance("invokable")->isBoolean());
        $this->assertFalse($this->getInstance("stringable")->isBoolean());
    }

    public function testIsIterable()
    {
        $this->assertFalse($this->getInstance("integer")->isIterable());
        $this->assertFalse($this->getInstance("float")->isIterable());
        $this->assertFalse($this->getInstance("string")->isIterable());
        $this->assertTrue($this->getInstance("array")->isIterable());
        $this->assertTrue($this->getInstance("callable")->isIterable());
        $this->assertTrue($this->getInstance("invalidCallable")->isIterable());
        $this->assertFalse($this->getInstance("null")->isIterable());
        $this->assertFalse($this->getInstance("boolean")->isIterable());
        $this->assertTrue($this->getInstance("iterable")->isIterable());
        $this->assertFalse($this->getInstance("closure")->isIterable());
        $this->assertFalse($this->getInstance("resource")->isIterable());
        $this->assertFalse($this->getInstance("object")->isIterable());
        $this->assertFalse($this->getInstance("invokable")->isIterable());
        $this->assertFalse($this->getInstance("stringable")->isIterable());
    }

    public function testToString()
    {
        $this->assertEquals("integer", strval($this->getInstance("integer")));
        $this->assertEquals("float", strval($this->getInstance("float")));
        $this->assertEquals("string", strval($this->getInstance("string")));
        $this->assertEquals("array", strval($this->getInstance("array")));
        $this->assertEquals("array", strval($this->getInstance("callable")));
        $this->assertEquals("array", strval($this->getInstance("invalidCallable")));
        $this->assertEquals("NULL", strval($this->getInstance("null")));
        $this->assertEquals("boolean", strval($this->getInstance("boolean")));
        $this->assertEquals("object (" . IterableClass::class . ")", strval($this->getInstance("iterable")));
        $this->assertEquals("anonymous function", strval($this->getInstance("closure")));
        $this->assertEquals("resource (stream)", strval($this->getInstance("resource")));
        $this->assertEquals("object (stdClass)", strval($this->getInstance("object")));
        $this->assertEquals("object (" . InvokableClass::class . ")", strval($this->getInstance("invokable")));
        $this->assertEquals("object (" . StringableClass::class . ")", strval($this->getInstance("stringable")));
    }

    public function testIsScalar()
    {
        $this->assertTrue($this->getInstance("integer")->isScalar());
        $this->assertTrue($this->getInstance("float")->isScalar());
        $this->assertTrue($this->getInstance("string")->isScalar());
        $this->assertFalse($this->getInstance("array")->isScalar());
        $this->assertFalse($this->getInstance("callable")->isScalar());
        $this->assertFalse($this->getInstance("invalidCallable")->isScalar());
        $this->assertFalse($this->getInstance("null")->isScalar());
        $this->assertTrue($this->getInstance("boolean")->isScalar());
        $this->assertFalse($this->getInstance("iterable")->isScalar());
        $this->assertFalse($this->getInstance("closure")->isScalar());
        $this->assertFalse($this->getInstance("resource")->isScalar());
        $this->assertFalse($this->getInstance("object")->isScalar());
        $this->assertFalse($this->getInstance("invokable")->isScalar());
        $this->assertFalse($this->getInstance("stringable")->isScalar());
    }

    public function testIsResource()
    {
        $this->assertFalse($this->getInstance("integer")->isResource());
        $this->assertFalse($this->getInstance("float")->isResource());
        $this->assertFalse($this->getInstance("string")->isResource());
        $this->assertFalse($this->getInstance("array")->isResource());
        $this->assertFalse($this->getInstance("callable")->isResource());
        $this->assertFalse($this->getInstance("invalidCallable")->isResource());
        $this->assertFalse($this->getInstance("null")->isResource());
        $this->assertFalse($this->getInstance("boolean")->isResource());
        $this->assertFalse($this->getInstance("iterable")->isResource());
        $this->assertFalse($this->getInstance("closure")->isResource());
        $this->assertTrue($this->getInstance("resource")->isResource());
        $this->assertFalse($this->getInstance("object")->isResource());
        $this->assertFalse($this->getInstance("invokable")->isResource());
        $this->assertFalse($this->getInstance("stringable")->isResource());
    }

    public function testIsString()
    {
        $this->assertFalse($this->getInstance("integer")->isString());
        $this->assertFalse($this->getInstance("float")->isString());
        $this->assertTrue($this->getInstance("string")->isString());
        $this->assertFalse($this->getInstance("array")->isString());
        $this->assertFalse($this->getInstance("callable")->isString());
        $this->assertFalse($this->getInstance("invalidCallable")->isString());
        $this->assertFalse($this->getInstance("null")->isString());
        $this->assertFalse($this->getInstance("boolean")->isString());
        $this->assertFalse($this->getInstance("iterable")->isString());
        $this->assertFalse($this->getInstance("closure")->isString());
        $this->assertFalse($this->getInstance("resource")->isString());
        $this->assertFalse($this->getInstance("object")->isString());
        $this->assertFalse($this->getInstance("invokable")->isString());
        $this->assertFalse($this->getInstance("stringable")->isString());
    }

    public function testIsStringable()
    {
        $this->assertFalse($this->getInstance("integer")->isStringable());
        $this->assertFalse($this->getInstance("float")->isStringable());
        $this->assertTrue($this->getInstance("string")->isStringable());
        $this->assertFalse($this->getInstance("array")->isStringable());
        $this->assertFalse($this->getInstance("callable")->isStringable());
        $this->assertFalse($this->getInstance("invalidCallable")->isStringable());
        $this->assertFalse($this->getInstance("null")->isStringable());
        $this->assertFalse($this->getInstance("boolean")->isStringable());
        $this->assertFalse($this->getInstance("iterable")->isStringable());
        $this->assertFalse($this->getInstance("closure")->isStringable());
        $this->assertFalse($this->getInstance("resource")->isStringable());
        $this->assertFalse($this->getInstance("object")->isStringable());
        $this->assertFalse($this->getInstance("invokable")->isStringable());
        $this->assertTrue($this->getInstance("stringable")->isStringable());
    }

    public function testGetType()
    {
        $this->assertEquals("integer", $this->getInstance("integer")->getType());
        $this->assertEquals("float", $this->getInstance("float")->getType());
        $this->assertEquals("string", $this->getInstance("string")->getType());
        $this->assertEquals("array", $this->getInstance("array")->getType());
        $this->assertEquals("array", $this->getInstance("callable")->getType());
        $this->assertEquals("array", $this->getInstance("invalidCallable")->getType());
        $this->assertEquals("NULL", $this->getInstance("null")->getType());
        $this->assertEquals("boolean", $this->getInstance("boolean")->getType());
        $this->assertEquals("object (" . IterableClass::class . ")", $this->getInstance("iterable")->getType());
        $this->assertEquals("anonymous function", $this->getInstance("closure")->getType());
        $this->assertEquals("resource (stream)", $this->getInstance("resource")->getType());
        $this->assertEquals("object (stdClass)", $this->getInstance("object")->getType());
        $this->assertEquals("object (" . InvokableClass::class . ")", $this->getInstance("invokable")->getType());
        $this->assertEquals("object (" . StringableClass::class . ")", $this->getInstance("stringable")->getType());
    }

    public function testIsObject()
    {
        $this->assertFalse($this->getInstance("integer")->isObject());
        $this->assertFalse($this->getInstance("float")->isObject());
        $this->assertFalse($this->getInstance("string")->isObject());
        $this->assertFalse($this->getInstance("array")->isObject());
        $this->assertFalse($this->getInstance("callable")->isObject());
        $this->assertFalse($this->getInstance("invalidCallable")->isObject());
        $this->assertFalse($this->getInstance("null")->isObject());
        $this->assertFalse($this->getInstance("boolean")->isObject());
        $this->assertTrue($this->getInstance("iterable")->isObject());
        $this->assertTrue($this->getInstance("closure")->isObject());
        $this->assertFalse($this->getInstance("resource")->isObject());
        $this->assertTrue($this->getInstance("object")->isObject());
        $this->assertTrue($this->getInstance("invokable")->isObject());
        $this->assertTrue($this->getInstance("stringable")->isObject());
    }

    public function testIsFloat()
    {
        $this->assertFalse($this->getInstance("integer")->isFloat());
        $this->assertTrue($this->getInstance("float")->isFloat());
        $this->assertFalse($this->getInstance("string")->isFloat());
        $this->assertFalse($this->getInstance("array")->isFloat());
        $this->assertFalse($this->getInstance("callable")->isFloat());
        $this->assertFalse($this->getInstance("invalidCallable")->isFloat());
        $this->assertFalse($this->getInstance("null")->isFloat());
        $this->assertFalse($this->getInstance("boolean")->isFloat());
        $this->assertFalse($this->getInstance("iterable")->isFloat());
        $this->assertFalse($this->getInstance("closure")->isFloat());
        $this->assertFalse($this->getInstance("resource")->isFloat());
        $this->assertFalse($this->getInstance("object")->isFloat());
        $this->assertFalse($this->getInstance("invokable")->isFloat());
        $this->assertFalse($this->getInstance("stringable")->isFloat());
    }

    public function testIsCallable()
    {
        $this->assertFalse($this->getInstance("integer")->isCallable());
        $this->assertFalse($this->getInstance("float")->isCallable());
        $this->assertFalse($this->getInstance("string")->isCallable());
        $this->assertFalse($this->getInstance("array")->isCallable());
        $this->assertTrue($this->getInstance("callable")->isCallable());
        $this->assertFalse($this->getInstance("invalidCallable")->isCallable());
        $this->assertFalse($this->getInstance("null")->isCallable());
        $this->assertFalse($this->getInstance("boolean")->isCallable());
        $this->assertFalse($this->getInstance("iterable")->isCallable());
        $this->assertTrue($this->getInstance("closure")->isCallable());
        $this->assertFalse($this->getInstance("resource")->isCallable());
        $this->assertFalse($this->getInstance("object")->isCallable());
        $this->assertTrue($this->getInstance("invokable")->isCallable());
        $this->assertFalse($this->getInstance("stringable")->isCallable());
    }

    private function getInstance(string $type)
    {
        if (!array_key_exists($type, $this->data)) {
            throw new \LogicException("Unknown data type: '{$type}'");
        }
        return new VariableType($this->data[$type]);
    }
}
