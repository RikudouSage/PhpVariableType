<?php

namespace rikudou\VariableType;

use Throwable;

class InvalidTypeException extends \InvalidArgumentException
{

    public function __construct(string $expectedType, $variable, int $code = 0, Throwable $previous = null)
    {
        $variableType = new VariableType($variable);
        $message = "Invalid argument type, expected '{$expectedType}', got '{$variableType}'";
        parent::__construct($message, $code, $previous);
    }

}