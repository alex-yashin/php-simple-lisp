<?php

namespace SimpleLisp\Functions;

class LessOrEqualFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $first = $context->calc(array_shift($params));

        foreach ($params as $value) {
            if ($context->calc($value) < $first) {
                return false;
            }
        }

        return true;
    }

}
