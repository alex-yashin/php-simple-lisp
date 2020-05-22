<?php

namespace SimpleLisp\Functions;

class MulFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = array_shift($params);

        foreach ($params as $value) {
            $acc = $acc * $value;
        }

        return $acc;
    }

}
