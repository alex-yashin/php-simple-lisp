<?php

namespace SimpleLisp\Functions;

class DivFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = array_shift($params);

        foreach ($params as $value) {
            $acc = $acc / $value;
        }

        return $acc;
    }

}
