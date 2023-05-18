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

        $r = [];
        foreach ($array as $item) {
            if ($context->calc(array($condition, $item))) {
                $r[] = $item;
            }
        }

        return $r;
    }

}
