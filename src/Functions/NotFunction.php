<?php

namespace SimpleLisp\Functions;

class NotFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $value = $context->calc(array_pop($params));
        
        return !$value;
    }

}
