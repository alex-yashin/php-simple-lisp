<?php

namespace SimpleLisp\Functions;

class CarFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $list = $context->calc(array_shift($params));
        return array_shift($list);
    }

}
