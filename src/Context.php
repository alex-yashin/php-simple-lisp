<?php

namespace SimpleLisp;

class Context
{

    private $library = [];
    protected $data = [];

    public function __construct()
    {
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
        $this->register('COND', new Functions\CondFunction());
        $this->register('IF', new Functions\IfFunction());
        $this->register('DEFUN', new Functions\DefunFunction());
    }

    public function load($data)
    {
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function set($name, $value)
    {
        $this->data[$name] = $value;
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

    public function calc($list)
    {
        if (!is_array($list)) {
            if (isset($list[0]) && $list[0] == "'") {
                return substr($list, 1);
            }
            
            if (is_numeric($list)) {
                return $list;
            }
            
            return $this->get($list);
        }

        $name = array_shift($list);
        $norm = strtoupper($name);
        if (!isset($this->library[$norm])) {
            throw new \Exception('Function "' . $name . '" is not found');
        }
        $func = $this->library[$norm];
        return $func->run($this, $list);
    }

}
