<?php

namespace SimpleLisp\Functions;

class QuoteFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        return array_shift($params);
    }

}
