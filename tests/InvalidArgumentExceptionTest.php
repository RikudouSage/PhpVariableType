<?php

namespace rikudou\VariableType\Tests;

use PHPUnit\Framework\TestCase;
use rikudou\VariableType\InvalidArgumentException;
use rikudou\VariableType\Types;

class InvalidArgumentExceptionTest extends TestCase
{

    public function testMessage()
    {
        try {
            throw new InvalidArgumentException(Types::INT, "string");
        } catch (InvalidArgumentException $exception) {
            $this->assertEquals($this->getMessage(Types::STRING, Types::INT), $exception->getMessage());
        }
    }

    private function getMessage(string $type, string $expectedType)
    {
        $message = "Invalid argument type, expected '%s', got '%s'";
        return sprintf($message, $expectedType, $type);
    }

}
