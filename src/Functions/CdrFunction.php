<?php

namespace SimpleLisp\Functions;

class CdrFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $list = $context->calc(array_shift($params));
        array_shift($list);
        return $list;
    }

}
