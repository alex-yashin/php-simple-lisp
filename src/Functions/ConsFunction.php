<?php

namespace SimpleLisp\Functions;

class ConsFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $item = $context->calc(array_shift($params));
        $list = $context->calc(array_shift($params));
        array_unshift($list, $item);
        return $list;
    }

}
