<?php

namespace SimpleLisp\Functions;

class UniqueFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $array = [];
        foreach ($params as $param) {
            $item = $context->calc($param);
            if (is_array($item)) {
                $array = array_merge($array, $item);
            } else {
                $array[] = $item;
            }
        }
        
        return array_values(array_unique($array));
    }
}
