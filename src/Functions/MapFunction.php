<?php


namespace SimpleLisp\Functions;

class MapFunction implements FunctionInterface
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
        foreach ($array as $k => $item) {
            $r[$k] = $context->calc(array($condition, $item, $k));
        }

        return $r;
    }

}
