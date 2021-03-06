<?php

namespace SimpleLisp\Functions;

class DivFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));

        foreach ($params as $value) {
            $acc = $acc / $context->calc($value);
        }

        return $acc;
    }

}
