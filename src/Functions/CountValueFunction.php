<?php

namespace SimpleLisp\Functions;

class CountValueFunction implements FunctionInterface
{

    public function run($context, $params)
    {
        $array = $context->calc(array_shift($params));
        $targetValue = $context->calc(array_shift($params));
        if (!is_array($array)) {
            return $array == $targetValue ? 1 : 0;
        }

        $count_values = array_count_values($array);

        return isset($count_values[$targetValue]) ? $count_values[$targetValue] : 0;
    }

}
