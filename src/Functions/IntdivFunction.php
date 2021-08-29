<?php

namespace SimpleLisp\Functions;

class IntdivFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));
        foreach ($params as $value) {
            $acc = intdiv($acc, $context->calc($value));
        }

        return $acc;
    }

}
