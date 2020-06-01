<?php

namespace SimpleLisp\Functions;

class MinFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $array = $context->calc(array_shift($params));
        
        return min($array);
    }

}
