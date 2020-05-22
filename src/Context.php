<?php

namespace SimpleLisp;

class Context
{

    private $library = [];
    protected $data = [];

    public function __construct()
    {
        $this->register('GET', new Functions\GetFunction());
        $this->register('AND', new Functions\AndFunction());
        $this->register('OR', new Functions\OrFunction());
        $this->register('NOT', new Functions\NotFunction());
        $this->register('=', new Functions\EqualFunction());
        $this->register('>=', new Functions\GreaterOrEqualFunction());
        $this->register('<=', new Functions\LessOrEqualFunction());
        $this->register('<', new Functions\LessFunction());
        $this->register('>', new Functions\GreaterFunction());
    }

    public function load($data)
    {
        $this->data = $data;
    }

    public function get($name)
    {
        return isset($this->data[$name]) ? $this->data[$name] : null;
    }

    public function register($name, $func)
    {
        $this->library[$name] = $func;
    }

    public function run($func, $params, $depth)
    {
        if (!isset($this->library[$func])) {
            return;
        }
        $function = $this->library[$func];
        return $function->run($this, $params);
    }

}
