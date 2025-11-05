<?php


namespace SimpleLisp\Functions;

class ReduceFunction implements FunctionInterface
{

    /**
     * @param \SimpleLisp\LispMachine $context
     * @param array $params
     * @return array|mixed
     * @throws \Exception
     */
    public function run($context, $params)
    {

        $array = $context->calc(array_shift($params));
        $condition = array_shift($params);

        $acc = null;
        foreach ($array as $k => $item) {
            $acc = $context->calc(array($condition, $acc, $item, $k));
        }

        return $acc;
    }

}
