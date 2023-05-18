<?php


namespace SimpleLisp\Functions;

class RangeFunction implements FunctionInterface
{

    /**
     * @param \SimpleLisp\LispMachine $context
     * @param array $params
     * @return array|mixed
     * @throws \Exception
     */
    public function run($context, $params)
    {

        $start = $context->calc(array_shift($params));
        $end = $context->calc(array_shift($params));
        $step = $context->calc(array_shift($params));

        return range($start, isset($end) ? $end : $start, isset($step) ? $step : 1);
    }

}
