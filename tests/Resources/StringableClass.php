<?php

namespace rikudou\VariableType\Tests\Resources;

class StringableClass
{

    public function __toString()
    {
        return "stringable class";
    }

}