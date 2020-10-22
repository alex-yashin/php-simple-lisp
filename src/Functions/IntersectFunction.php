<?php

namespace SimpleLisp\Functions;

class IntersectFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $param = array_shift($params);
        $item = $context->calc($param);
        $array = is_array($item) ? $item : [$item];
        foreach ($params as $param) {
            $item = $context->calc($param);
            $array = array_intersect($array, is_array($item) ? $item : [$item]);
        }
        
        return $array;
    }

}
