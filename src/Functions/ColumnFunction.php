<?php

namespace SimpleLisp\Functions;

class ColumnFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        
        $array = $context->calc(array_shift($params));
        $column = $context->calc(array_shift($params));
        
        if (!is_array($array)) {
            return [];
        }
        
        return array_column($array, $column);
    }

}
