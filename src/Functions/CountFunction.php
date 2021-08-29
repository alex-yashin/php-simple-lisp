<?php

namespace SimpleLisp\Functions;

class CountFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $param = $context->calc(array_shift($params));
        
        if (!is_array($param)) {
            return 0;
        }

        return count($param);
    }

}
