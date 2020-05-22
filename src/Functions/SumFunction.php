<?php

namespace SimpleLisp\Functions;

class SumFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        return array_sum($params);
    }

}
