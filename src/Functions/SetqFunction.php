<?php

namespace SimpleLisp\Functions;

class SetqFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $name = array_shift($params);
        $value = $context->calc(array_shift($params));
        $context->set($name, $value);
        
        return $value;
    }

}
