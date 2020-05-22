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
        $this->register('+', new Functions\SumFunction());
        $this->register('-', new Functions\SubFunction());
        $this->register('*', new Functions\MulFunction());
        $this->register('/', new Functions\DivFunction());
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
        $norm = strtoupper($name);
        $this->library[$norm] = $func;
    }

    public function run($name, $params)
    {
        $norm = strtoupper($name);
        if (!isset($this->library[$norm])) {
            throw new \Exception('Function "' . $name . '" is not found');
        }
        $func = $this->library[$norm];
        return $func->run($this, $params);
    }

}
