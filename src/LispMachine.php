<?php

namespace SimpleLisp;

class LispMachine
{

    private $context;

    public function __construct($context)
    {
        $this->context = $context;
    }

    public function run($stats)
    {
        $r = null;
        foreach ($stats as $list) {
            $r = $this->context->calc($list);
        }
        return $r;
    }
    
    public function parseAndRun($program)
    {
        $syntax = new LispSyntax;
        return $this->run($syntax->parse($program));
    }

}
