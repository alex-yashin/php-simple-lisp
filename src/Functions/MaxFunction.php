<?php

namespace SimpleLisp\Functions;

class MaxFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $array = $context->calc(array_shift($params));

        return max($array);
    }

}
