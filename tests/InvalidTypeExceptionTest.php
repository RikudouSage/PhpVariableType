<?php

namespace rikudou\VariableType\Tests;

use PHPUnit\Framework\TestCase;
use rikudou\VariableType\InvalidTypeException;
use rikudou\VariableType\Types;

class InvalidTypeExceptionTest extends TestCase
{

    public function testMessage()
    {
        try {
            throw new InvalidTypeException(Types::INT, "string");
        } catch (InvalidTypeException $exception) {
            $this->assertEquals($this->getMessage(Types::STRING, Types::INT), $exception->getMessage());
        }
    }

    private function getMessage(string $type, string $expectedType)
    {
        $message = "Invalid argument type, expected '%s', got '%s'";
        return sprintf($message, $expectedType, $type);
    }

}
