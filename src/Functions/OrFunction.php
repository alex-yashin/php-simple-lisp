<?php

namespace SimpleLisp\Functions;

class OrFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $acc = false;

        foreach ($params as $value) {
            $acc = $acc || $value;
        }

        return $acc;
    }

}
