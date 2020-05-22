<?php

namespace SimpleLisp\Functions;

class IfFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $cond = $context->calc(array_shift($params));
        if ($cond) {
            return $context->calc(array_shift($params));
        }
        array_shift($params);
        return $context->calc(array_shift($params));
    }

}
