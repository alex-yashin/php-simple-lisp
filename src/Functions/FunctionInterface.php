<?php

namespace SimpleLisp\Functions;

interface FunctionInterface
{

    /**
     * Выполняет функцию в контектсе определенной машины с заданными параметрами
     * @param \SimpleLisp\LispMachine $context
     * @param array $params
     * @return mixed
     */
    public function run($context, $params);

}
