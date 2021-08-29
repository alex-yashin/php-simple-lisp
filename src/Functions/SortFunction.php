<?php

namespace SimpleLisp\Functions;

class SortFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));
        $direction = $context->calc(array_shift($params));

        sort($acc, SORT_NATURAL);
        if ($direction === 'DESC' || $direction === 'desc') {
            $acc = array_reverse($acc);
        }

        return $acc;
    }

}
