<?php

namespace SimpleLisp\Functions;

class InFunction implements FunctionInterface
{

    /**
     * @param \SimpleLisp\LispMachine $context
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function run($context, $params)
    {
        $needle = $context->calc(array_shift($params));

        foreach ($params as $value) {
            $calculated = $context->calc($value);

            if (is_array($calculated) && in_array($needle, $calculated)) {
                return true;
            }

            if ($needle == $calculated) {
                return true;
            }
        }

        return false;
    }

}
