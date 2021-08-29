<?php

namespace SimpleLisp\Functions;

class SumListFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));

        return array_sum($acc);
    }

}
