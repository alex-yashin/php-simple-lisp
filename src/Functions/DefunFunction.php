<?php

namespace SimpleLisp\Functions;

class DefunFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $name = array_shift($params);
        $context->register($name, new UserFunction($params));
        
        return null;
    }

}
