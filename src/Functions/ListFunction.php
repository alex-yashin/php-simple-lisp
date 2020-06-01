<?php

namespace SimpleLisp\Functions;

class ListFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $r = [];
        foreach ($params as $p) {
            $r[] = $context->calc($p);
        }
        return $r;
    }

}
