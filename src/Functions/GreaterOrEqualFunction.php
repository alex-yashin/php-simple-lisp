<?php

namespace SimpleLisp\Functions;

class GreaterOrEqualFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $first = $context->calc(array_shift($params));

        foreach ($params as $value) {
            if ($context->calc($value) > $first) {
                return false;
            }
        }

        return true;
    }

}
