<?php

namespace SimpleLisp\Functions;

class EqualFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $first = array_shift($params);

        foreach ($params as $value) {
            if ($value != $first) {
                return false;
            }
        }

        return true;
    }

}
