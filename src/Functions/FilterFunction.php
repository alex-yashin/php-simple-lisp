<?php

namespace SimpleLisp\Functions;

class FilterFunction implements FunctionInterface
{

    public function run($context, $params)
    {

        $array = $context->calc(array_shift($params));
        $condition = array_shift($params);
        
        $oldState = $context->getState();
        $r = [];
        foreach ($array as $item) {
            foreach ($item as $k => $v) {
                $context->set($k, $v);
            }
            
            if ($context->calc($condition)) {
                $r[] = $item;
            }
        }
        
        $context->setState($oldState);
        
        return $r;
    }

}
