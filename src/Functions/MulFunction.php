<?php

namespace SimpleLisp\Functions;

class MulFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));

        foreach ($params as $value) {
            $acc = $acc * $context->calc($value);
        }

        return $acc;
    }

}
