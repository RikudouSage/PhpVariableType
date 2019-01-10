<?php

namespace rikudou\VariableType\Tests\Resources;

class InvokableClass
{

    public function __invoke()
    {
        return null;
    }

}