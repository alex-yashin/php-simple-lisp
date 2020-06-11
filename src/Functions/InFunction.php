<?php

namespace SimpleLisp\Functions;

class InFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $first = $context->calc(array_shift($params));
        
        return $this->inArray($context, $first, $params);
    }
    
    public function inArray($context, $first, $params)
    {
        foreach ($params as $value) {
            $calculated = $context->calc($value);
            if (is_array($calculated) && $this->inArray($context, $first, $calculated)) {
                return true;
            }
            
            if ($calculated == $first) {
                return true;
            }
        }

        return false;
    }

}
