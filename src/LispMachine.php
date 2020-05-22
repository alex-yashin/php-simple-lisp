<?php

namespace SimpleLisp;

class LispMachine
{

    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function run($list)
    {
        if (!is_array($list)) {
            return $list;
        }
        
        $func = array_shift($list);
        foreach ($list as $k => $v) {
            if (is_array($v)) {
                $list[$k] = $this->run($v);
            }
        }

        return $this->context->run($func, $list);
    }
    
    public function parseAndRun($program)
    {
        $syntax = new LispSyntax;
        return $this->run($syntax->parse($program));
    }

}
