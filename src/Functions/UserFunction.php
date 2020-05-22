<?php

namespace SimpleLisp\Functions;

class UserFunction implements FunctionInterface
{
    protected $args = [];
    protected $stats = [];


    public function __construct($list)
    {
        $this->args = array_shift($list);
        $this->stats = $list;
    }

    public function run($context, $params)
    {
        $state = $context->getState();
        $ps = [];
        foreach ($this->args as $i => $name) {
            $value = $params[$i];
            $ps[$name] = $context->calc($value);
        }
        
        foreach ($ps as $k => $v) {
            $context->set($k, $v);
        }
        
        $r = null;
        foreach ($this->stats as $stat) {
            $r = $context->calc($stat);
        }
        
        $context->setState($state);
        return $r;
    }

}
