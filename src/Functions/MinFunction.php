<?php

namespace SimpleLisp\Functions;

class MinFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $array = [];
        foreach ($params as $param) {
            $array[] = $context->calc($param);
        }
        
        if (count($array) > 1) {
            return min($array);
        }
        
        if (count($array) == 1 && is_array($array[0])) {
            return $this->run($context, $array[0]);
        }
        
        return isset($array[0]) ? $array[0] : null;
    }

}
