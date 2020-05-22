<?php

namespace SimpleLisp\Functions;

class SubFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $first = array_shift($params);
        return $first - array_sum($params);
    }

}
