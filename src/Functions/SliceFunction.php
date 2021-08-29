<?php

namespace SimpleLisp\Functions;

class SliceFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = $context->calc(array_shift($params));
        $offset = $context->calc(array_shift($params));
        $length = $context->calc(array_shift($params));

        return array_slice($acc, $offset, $length);
    }

}
