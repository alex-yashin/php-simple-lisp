<?php

namespace SimpleLisp\Functions;

class GetFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $variable = array_shift($params);
        return $context->get($variable);
    }

}
