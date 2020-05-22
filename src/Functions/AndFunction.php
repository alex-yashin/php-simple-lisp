<?php

namespace SimpleLisp\Functions;

class AndFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = true;
        
        foreach ($params as $value) {
            $acc = $acc && $value;
        }
        
        return $acc;
    }

}
