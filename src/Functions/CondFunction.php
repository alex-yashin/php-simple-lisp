<?php

namespace SimpleLisp\Functions;

class CondFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        while ($branch = array_shift($params)) {
            list($cond, $stat) = $branch;
            if ($context->calc($cond)) {
                return $context->calc($stat);
            }
        }
        return null;
    }

}
